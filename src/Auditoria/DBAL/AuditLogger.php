<?php

/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 24/02/2017
 * Time: 05:13 PM
 */

namespace  App\Auditoria\DBAL;
use Doctrine\DBAL\Logging\SQLLogger;

class AuditLogger implements SQLLogger
{
    /**
     * @var callable
     */
    private $flusher;
    public function __construct(callable $flusher)
    {
        $this->flusher = $flusher;
    }
    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        // right before commit insert all audit entries
        if ($sql === '"COMMIT"') {
            call_user_func($this->flusher);
        }
    }
    /**
     * {@inheritdoc}
     */
    public function stopQuery()
    {
    }
}