<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 02/02/2017
 * Time: 03:00 PM.
 */

namespace App\Auditoria\EventListener;

use App\Auditoria\Annotation\Auditar;
use App\Auditoria\Annotation\Exclude;
use DateTime;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\MappingException;
use Exception;
use Monolog\Logger;
use App\Auditoria\DBAL\AuditLogger;
use App\Auditoria\Entity\Association;
use App\Auditoria\Entity\AuditoriaLog;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\UnitOfWork;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\SQLLogger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Role\SwitchUserRole;


class AuditoriaListener
{
    private $tokenStorage;
    private $reader;
    private $logger;

    private $entidadesAuditadas = [];
    private $propiedadesAuditadas = [];

    private $inserted = []; // [$source, $changeset]
    private $updated = []; // [$source, $changeset]
    private $removed = []; // [$source, $id]
    private $associated = []; // [$source, $target, $mapping]
    private $dissociated = []; // [$source, $target, $id, $mapping]
    private $old;

    /**
     *
     * @param TokenStorage $tokenStorage
     * @param Reader $reader
     * @param LoggerInterface $logger
     */


    public function __construct(TokenStorage $tokenStorage, Reader $reader, LoggerInterface $logger)
    {
        $this->tokenStorage = $tokenStorage;
        $this->reader = $reader;
        $this->logger = $logger;
    }

    /**
     * Chequea que la entidad sea auditable, para eso debe tener la Annotation Auditar
     *
     * @param EntityManager $em
     * @param $entity
     * @return bool
     * @throws ReflectionException
     */
    public function esEntidadNoAuditable(EntityManager $em, $entity)
    {
        $entidadClase = $em->getClassMetadata(get_class($entity))->getName();

        // Chequear que habilito el audit para esta entity
        $reflectionClass = new ReflectionClass($entidadClase);

        $classAnnotations = $this->reader->getClassAnnotation($reflectionClass, Auditar::class);

        if ($classAnnotations != null)
            return false;
        else
            return true;
    }

    /**
     * @param EntityManager $em
     * @param $entity
     * @param $properties_to_change
     * @return array
     * @throws ReflectionException
     */
    public function quitarPropiedadesNoAuditables(EntityManager $em, $entity, $properties_to_change)
    {
        $meta = $em->getClassMetadata(get_class($entity));
        $reflectionClass = new ReflectionClass($meta->getName());
        $cambios_a_auditar = array();

        foreach ($properties_to_change as $propertyName => $propertyValue) {
            try {
                $reflectionProperty = $reflectionClass->getProperty($propertyName);

                $annotation = $this->reader->getPropertyAnnotation($reflectionProperty, Exclude::class);
                if ($annotation == null)
                    $cambios_a_auditar[$propertyName] = $propertyValue;
                else
                    continue;
            }
                // Si lanza excepcion es porque es una proxy class que hereda de entity y los atributos
                // private no sale en el reflection, en ese caso registro log de error y hay que revisar
            catch (Exception $e) {
                $this->logger(Logger::ERROR, "Error al registrar cambio en la propiedad '" . $propertyName . "' de la entidad '" . $meta . "''");
            }
        }
        return $cambios_a_auditar;
    }

    /**
     * @param OnFlushEventArgs $eventArgs
     * @throws ReflectionException
     * @throws DBALException
     * @throws MappingException
     */
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        /**@var $uow UnitOfWork */
        /**@var  $em  EntityManager */
        $this->em = $eventArgs->getEntityManager();
        $uow = $this->em->getUnitOfWork();


        /*****A CAMBIARRRRRRRRRRRRRRRRRRR*/

        $em = $eventArgs->getEntityManager();
        // extend the sql logger
        $this->old = $this->em->getConnection()->getConfiguration()->getSQLLogger();
        $new = new LoggerChain();
        $new->addLogger(new AuditLogger(function () use ($em) {
            $this->flush($em);
        }));
        if ($this->old instanceof SQLLogger) {
            $new->addLogger($this->old);
        }
        $em->getConnection()->getConfiguration()->setSQLLogger($new);

        /***A CAMBIAR FIN****************************/


        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if ($this->esEntidadNoAuditable($em, $entity)) {
                continue;
            }

            $this->inserted[] = [$entity, $uow->getEntityChangeSet($entity)];
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if ($this->esEntidadNoAuditable($em, $entity)) {
                continue;
            }

            $this->updated[] = [$entity, $uow->getEntityChangeSet($entity)];
        }

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            if ($this->esEntidadNoAuditable($em, $entity)) {
                continue;
            }

            $uow->initializeObject($em, $entity);
            $this->removed[] = [$entity, $this->id($em, $entity)];
        }

        foreach ($uow->getScheduledCollectionUpdates() as $collection) {
            if ($this->esEntidadNoAuditable($em, $collection->getOwner())) {
                continue;
            }
            $mapping = $collection->getMapping();

            if (!$mapping['isOwningSide'] || $mapping['type'] !== ClassMetadataInfo::MANY_TO_MANY) {
                continue; // ignore inverse side or one to many relations
            }


            foreach ($collection->getInsertDiff() as $entity) {
                if ($this->esEntidadNoAuditable($em, $entity)) {
                    continue;
                }
                $this->associated[] = [$collection->getOwner(), $entity, $mapping];
            }


            foreach ($collection->getDeleteDiff() as $entity) {
                if ($this->esEntidadNoAuditable($em, $entity)) {
                    continue;
                }
                $this->dissociated[] = [$collection->getOwner(), $entity, $this->id($em, $entity), $mapping];
            }

        }

        foreach ($uow->getScheduledCollectionDeletions() as $collection) {
            if ($this->esEntidadNoAuditable($em, $collection->getOwner())) {
                continue;
            }
            $mapping = $collection->getMapping();

            if (!$mapping['isOwningSide'] || $mapping['type'] !== ClassMetadataInfo::MANY_TO_MANY) {
                continue; // ignore inverse side or one to many relations
            }
            foreach ($collection->toArray() as $entity) {
                if ($this->esEntidadNoAuditable($em, $entity)) {
                    continue;
                }
                $this->dissociated[] = [$collection->getOwner(), $entity, $this->id($em, $entity), $mapping];
            }

        }
    }

    /**
     * @param EntityManager $em
     * @throws ReflectionException
     */
    private function flush(EntityManager $em)
    {
        $uow = $em->getUnitOfWork();


        /**BORARRRR*****/////////
        $auditPersister = $uow->getEntityPersister(AuditoriaLog::class);
        $rmAuditInsertSQL = new ReflectionMethod($auditPersister, 'getInsertSQL');
        $rmAuditInsertSQL->setAccessible(true);
        $this->auditInsertStmt = $this->em->getConnection()->prepare($rmAuditInsertSQL->invoke($auditPersister));

        $assocPersister = $uow->getEntityPersister(Association::class);
        $rmAssocInsertSQL = new ReflectionMethod($assocPersister, 'getInsertSQL');
        $rmAssocInsertSQL->setAccessible(true);
        $this->assocInsertStmt = $this->em->getConnection()->prepare($rmAssocInsertSQL->invoke($assocPersister));

        /**FIN DE BORARRRRR*/
        foreach ($this->updated as $entry) {
            list($entity, $ch) = $entry;
            // the changeset might be updated from UOW extra updates
            $ch = array_merge($ch, $uow->getEntityChangeSet($entity));
            $ch = $this->quitarPropiedadesNoAuditables($em, $entity, $ch);
            $this->update($em, $entity, $ch);
        }

        foreach ($this->inserted as $entry) {
            list($entity, $ch) = $entry;
            // the changeset might be updated from UOW extra updates
            $ch = array_merge($ch, $uow->getEntityChangeSet($entity));
            $ch = $this->quitarPropiedadesNoAuditables($em, $entity, $ch);
            $this->insert($em, $entity, $ch);
        }

        foreach ($this->associated as $entry) {
            list($source, $target, $mapping) = $entry;
            $this->associate($em, $source, $target, $mapping);
        }
        foreach ($this->dissociated as $entry) {
            list($source, $target, $id, $mapping) = $entry;
            $this->dissociate($em, $source, $target, $id, $mapping);
        }
        foreach ($this->removed as $entry) {
            list($entity, $id) = $entry;
            $this->remove($em, $entity, $id);
        }

        $this->inserted = [];
        $this->updated = [];
        $this->removed = [];
        $this->associated = [];
        $this->dissociated = [];

    }

    private function update(EntityManager $em, $entity, array $ch)
    {
        $diff = $this->diff($em, $entity, $ch);

        if (!$diff) {
            return; // if there is no entity diff, do not log it
        }

        $meta = $em->getClassMetadata(get_class($entity));

        $this->audit($em, [
            'action' => 'update',
            'source' => $this->assoc($em, $entity),
            'target' => null,
            'blame' => $this->blame($em),
            'blame_impersonate' => $this->Impersonateblame($em),
            'diff' => $diff,
            'tbl' => $meta->table['name'],
        ]);
    }

    private function insert(EntityManager $em, $entity, array $ch)
    {
        $meta = $em->getClassMetadata(get_class($entity));
        $this->audit($em, [
            'action' => 'insert',
            'source' => $this->assoc($em, $entity),
            'target' => null,
            'blame' => $this->blame($em),
            'blame_impersonate' => $this->Impersonateblame($em),
            'diff' => $this->diff($em, $entity, $ch),
            'tbl' => $meta->table['name'],
        ]);
    }

    private function associate(EntityManager $em, $source, $target, array $mapping)
    {
        $this->audit($em, [
            'source' => $this->assoc($em, $source),
            'target' => $this->assoc($em, $target),
            'action' => 'associate',
            'blame' => $this->blame($em),
            'blame_impersonate' => $this->Impersonateblame($em),
            'diff' => null,
            'tbl' => $mapping['joinTable']['name'],
        ]);
    }

    private function dissociate(EntityManager $em, $source, $target, $id, array $mapping)
    {
        $this->audit($em, [
            'source' => $this->assoc($em, $source),
            'target' => array_merge($this->assoc($em, $target), ['fk' => $id]),
            'action' => 'dissociate',
            'blame' => $this->blame($em),
            'blame_impersonate' => $this->Impersonateblame($em),
            'diff' => null,
            'tbl' => $mapping['joinTable']['name'],
        ]);
    }

    private function remove(EntityManager $em, $entity, $id)
    {
        $meta = $em->getClassMetadata(get_class($entity));
        $source = array_merge($this->assoc($em, $entity), ['fk' => $id]);
        $this->audit($em, [
            'action' => 'remove',
            'source' => $source,
            'target' => null,
            'blame' => $this->blame($em),
            'blame_impersonate' => $this->Impersonateblame($em),
            'diff' => null,
            'tbl' => $meta->table['name'],
        ]);
    }

    /**
     * @param EntityManager $em
     * @param array $data
     * @throws DBALException
     */
    private function audit(EntityManager $em, array $data)
    {
        $c = $em->getConnection();
        $p = $c->getDatabasePlatform();
        $q = $em->getConfiguration()->getQuoteStrategy();

        $ip = array_key_exists('REMOTE_ADDR', $_SERVER) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
        $data['ip'] = $ip;

        foreach (['source', 'target', 'blame', 'blame_impersonate'] as $field) {

            if (null === $data[$field]) {
                continue;
            }
            $meta = $em->getClassMetadata(Association::class);
            $idx = 1;
            foreach ($meta->reflFields as $name => $f) {
                if ($meta->isIdentifier($name)) {
                    continue;
                }
                $typ = $meta->fieldMappings[$name]['type'];
                $this->assocInsertStmt->bindValue($idx++, $data[$field][$name], $typ);
            }
            $this->assocInsertStmt->execute();
            // use id generator, it will always use identity strategy, since our
            // audit association explicitly sets that.
            $data[$field] = $meta->idGenerator->generate($em, null);
        }


        $meta = $em->getClassMetadata(AuditoriaLog::class);
        $data['loggedAt'] = new DateTime();
        $idx = 1;
        foreach ($meta->reflFields as $name => $f) {
            if ($meta->isIdentifier($name)) {
                continue;
            }
            if (isset($meta->fieldMappings[$name]['type'])) {
                $typ = $meta->fieldMappings[$name]['type'];
            } else {
                $typ = Type::getType(Type::BIGINT); // relation
            }
            // @TODO: this check may not be necessary, simply it ensures that empty values are nulled
            if (in_array($name, ['source', 'target', 'blame', 'blame_impersonate']) && $data[$name] === false) {
                $data[$name] = null;
            }
            $this->auditInsertStmt->bindValue($idx++, $data[$name], $typ);

        }
        $this->auditInsertStmt->execute();
    }

    private function diff(EntityManager $em, $entity, array $ch)
    {
        //$uow = $em->getUnitOfWork();
        $meta = $em->getClassMetadata(get_class($entity));
        $diff = [];
        foreach ($ch as $fieldName => list($old, $new)) {
            if ($meta->hasField($fieldName)) {
                $mapping = $meta->fieldMappings[$fieldName];
                $diff[$fieldName] = [
                    'old' => $this->value($em, Type::getType($mapping['type']), $old),
                    'new' => $this->value($em, Type::getType($mapping['type']), $new),
                    'col' => $mapping['columnName'],
                ];
            } elseif ($meta->hasAssociation($fieldName) && $meta->isSingleValuedAssociation($fieldName)) {
                //$mapping = $meta->associationMappings[$fieldName];
                $colName = $meta->getSingleAssociationJoinColumnName($fieldName);
                //$assocMeta = $em->getClassMetadata($mapping['targetEntity']);
                $diff[$fieldName] = [
                    'old' => $this->assoc($em, $old),
                    'new' => $this->assoc($em, $new),
                    'col' => $colName,
                ];
            }
        }
        return $diff;
    }

    private function value(EntityManager $em, Type $type, $value)
    {
        $platform = $em->getConnection()->getDatabasePlatform();
        switch ($type->getName()) {
            case Type::BOOLEAN:
                return $type->convertToPHPValue($value, $platform); // json supports boolean values
            default:
                return $type->convertToDatabaseValue($value, $platform);
        }
    }

    private function assoc(EntityManager $em, $association = null)
    {
        if (null === $association) {
            return null;
        }
        $meta = $em->getClassMetadata(get_class($association));
        $res = ['class' => $meta->name, 'typ' => $this->typ($meta->name), 'tbl' => $meta->table['name']];
        $em->getUnitOfWork()->initializeObject($association); // ensure that proxies are initialized
        $res['fk'] = (string)$this->id($em, $association);
        $res['label'] = $this->label($em, $association);

        return $res;
    }

    /**
     * @param EntityManager $em
     * @param $entity
     * @return string
     * @throws DBALException
     * @throws MappingException
     */
    private function id(EntityManager $em, $entity)
    {
        $meta = $em->getClassMetadata(get_class($entity));
        $pk = $meta->getSingleIdentifierFieldName();
        $pk = $this->value(
            $em,
            Type::getType($meta->fieldMappings[$pk]['type']),
            $meta->getReflectionProperty($pk)->getValue($entity)
        );
        return $pk;
    }

    private function typ($className)
    {
        // strip prefixes and repeating garbage from name
        $className = preg_replace("/^(.+\\\)?(.+)(Bundle\\\Entity)/", "$2", $className);
        // underscore and lowercase each subdirectory
        return implode('.', array_map(function ($name) {
            return strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/', '_$1', $name));
        }, explode('\\', $className)));
    }

    private function label(EntityManager $em, $entity)
    {
//        if (is_callable($this->labeler)) {
//            return call_user_func($this->labeler, $entity);
//        }
        $meta = $em->getClassMetadata(get_class($entity));
        switch (true) {
            case $meta->hasField('title'):
                return $meta->getReflectionProperty('title')->getValue($entity);
            case $meta->hasField('name'):
                return $meta->getReflectionProperty('name')->getValue($entity);
            case $meta->hasField('label'):
                return $meta->getReflectionProperty('label')->getValue($entity);
            case $meta->getReflectionClass()->hasMethod('__toString'):
                return (string)$entity;
            default:
                return "Unlabeled";
        }
    }

    protected function blame(EntityManager $em)
    {

        $token = $this->tokenStorage->getToken();

        if ($token && $user = $token->getUser()) {
            if (is_object($user)) {
                return $this->assoc($em, $user);
            }
        }
        return null;
    }

    protected function Impersonateblame(EntityManager $em)
    {
        $token = $this->tokenStorage->getToken();
        // dump($token != null); exit;
        if ($token != null) {
            foreach ($token->getRoles() as $role) {
                /** @var  $role SwitchUserRole */
                if ($role instanceof SwitchUserRole) {

                    // old version, al parecer quitaron ROLE_ALLOWED_TO_SWITCH cuando se suplanta
                    foreach ($role->getSource()->getRoles() as $role_source)
                        if ($role_source->getRole() == "ROLE_ALLOWED_TO_SWITCH") {
                            if ($role->getSource() && $user = $role->getSource()->getUser()) {
                                if (is_object($user)) {
                                    return $this->assoc($em, $user);
                                }
                            }
                        }

                    if ($role->getRole() == "ROLE_PREVIOUS_ADMIN") {
                        if ($role->getSource() && $user = $role->getSource()->getUser()) {
                            if (is_object($user)) {
                                return $this->assoc($em, $user);
                            }
                        }
                    }

                }
            }
        }
        return null;
    }

}

