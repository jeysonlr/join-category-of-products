<?php

declare(strict_types=1);

namespace Infrastructure\Service\DatabaseSabium;

use Psr\Container\ContainerInterface;

class SabiumDatabaseConnectionCheckServiceFactory
{
    public function __invoke(ContainerInterface $container): SabiumDatabaseConnectionCheckService
    {
        return new SabiumDatabaseConnectionCheckService($container);
    }
}
