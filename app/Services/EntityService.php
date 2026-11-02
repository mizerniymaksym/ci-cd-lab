<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\ExportableInterface;
use App\Interfaces\LoggerInterface;
use App\Models\AbstractEntity;

class EntityService
{
    public function __construct(private LoggerInterface $logger) {}

    public function register(AbstractEntity $entity): string
    {
        $details = $entity->getDetails();
        $this->logger->log("Зареєстровано сутність #{$entity->getId()}: {$details}");

        return $details;
    }

    public function export(ExportableInterface $entity): string
    {
        $json = $entity->exportToJson();
        $this->logger->log('Сутність експортовано у JSON ('.strlen($json).' байт)');

        return $json;
    }
}
