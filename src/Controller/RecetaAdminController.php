<?php


namespace App\Controller;


use App\Entity\AppCristal;
use App\Entity\AppPaciente;
use App\Entity\AppReceta;
use App\Entity\Nomenclador\NcAdd;
use App\Entity\Nomenclador\NcAgudezaVisual;
use App\Entity\Nomenclador\NcDp;
use App\Entity\Nomenclador\NcEje;
use App\Entity\SecurityUser;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use Exception;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Filter\FilterInterface;
use Sonata\DoctrineORMAdminBundle\Filter\ModelFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecetaAdminController extends CRUDController
{
    /**
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function crearRecetaPacienteAction($id)
    {
        /** @var SecurityUser $user */
        $user = $this->getUser();

        /** @var string $class */
        $class = $this->admin->getClass();
        $this->admin->setSubject(new $class());

        /** @var AppReceta $object */
        $object = $this->admin->getSubject();

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var AppPaciente $paciente */
        $paciente = $em->find(AppPaciente::class, $id);

        if ($this->getRestMethod() === Request::METHOD_POST) {

            $resquest = $this->getRequest()->request->get($this->admin->getUniqid());

            foreach ($resquest as $key => $item) {

                # Cambiando el caracter _ por un espacio
                $string = preg_replace('(_)', ' ', $key);
                # Convertir la primera letra en mayúscula
                $string = ucwords($string);
                # Unir todas las palabras
                $string = preg_replace('( )', '', $string);

                if (!method_exists($object, sprintf('get%s', $string))) {
                    continue;
                }

                switch (sprintf('set%s', $string)) {
                    case 'setFechaRefraccion':
                        $item = new DateTime($item);
                        break;
                    case 'setDp':
                        $item = $em->find(NcDp::class, $item);
                        break;
                    case 'setAdd':
                        $item = $em->find(NcAdd::class, $item);
                        break;
                    case 'setEjeOd':
                        $item = $em->find(NcEje::class, $item);
                        break;
                    case 'setAVisualOd':
                        $item = $em->find(NcAgudezaVisual::class, $item);
                        break;
                    case 'setCristalOd':
                        $item = $em->find(AppCristal::class, $item);
                        break;
                    case 'setEjeOi':
                        $item = $em->find(NcEje::class, $item);
                        break;
                    case 'setAVisualOi':
                        $item = $em->find(NcAgudezaVisual::class, $item);
                        break;
                    case 'setCristalOi':
                        $item = $em->find(AppCristal::class, $item);
                }

                call_user_func_array(array($object, sprintf('set%s', $string)), array($item));

            }

            $object->setPaciente($paciente);
            $object->setUsuarioCreador($user);
            $object->setOfficeCreacion($user->getOffice());

            $em->persist($object);
            $em->flush();

            return $this->redirectToRoute('admin_app_apppaciente_list');
        }

        return $this->renderWithExtraParams('::Admin/receta/create_receta_paciente.html.twig', array(
            'id' => $id,
            'object' => $object,
            'paciente' => $paciente,
            'form' => $this->admin->getForm()->createView(),
        ));
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function listaRecetaPacienteAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var AppReceta $object */
        $object = null;

        /** @var AppPaciente $paciente */
        $paciente = $em->find(AppPaciente::class, $id);
        $object = $em->getRepository(AppReceta::class)->findBy(['paciente' => $paciente], ['created_at' => 'DESC']);

        $form = $this->admin->getDatagrid()->getForm();

        dump($this->admin->getDatagrid()->getFilters());
//        exit;
//        $filter =  new ModelFilter();
//        $filter->isActive();
//        dump($this->admin->getDatagrid()->addFilter($filter));
//        $object = $em->getRepository(AppReceta::class)->findBy(['paciente' => $paciente], ['created_at' => 'DESC']);

//        $list = $this->admin->getListBuilder()->getBaseList();

//        $list = $this->get('sonata.admin.app.receta')->getListBuilder();
//dump($list);exit;

//        $listMapper = new ListMapper($this->admin->getListBuilder(), $this->admin->getListBuilder()->getBaseList(), $this->admin);

//        return $this->admin->getTemplate('select');
//        dump($listMapper);exit;
//
        return $this->renderWithExtraParams('::Admin/receta/lista_receta_paciente.html.twig', array(
            'id' => $id,
            'form' => $form->createView(),
        ));
    }

}