<?php

declare(strict_types=1);

namespace Infrastructure\Service\CheckDatabase;

use Psr\Container\ContainerInterface;

class DatabaseConnectionCheckServiceFactory
{
    public function __invoke(ContainerInterface $container): DatabaseConnectionCheckService
    {
        return new DatabaseConnectionCheckService($container);
    }
}
