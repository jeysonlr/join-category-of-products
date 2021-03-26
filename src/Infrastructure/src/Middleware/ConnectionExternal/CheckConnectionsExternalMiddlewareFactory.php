<?php

declare(strict_types=1);

namespace Infrastructure\Middleware\ConnectionExternal;

use Psr\Container\ContainerInterface;
use Infrastructure\Service\DatabaseSabium\SabiumDatabaseConnectionCheckService;

class CheckConnectionsExternalMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CheckConnectionsExternalMiddleware
    {
        $configRoutes = $container->get('config')['data-routes-external-services'];
        $checkConnectionDatabasesabium = $container->get(SabiumDatabaseConnectionCheckService::class);
        return new CheckConnectionsExternalMiddleware(
            $configRoutes,
            $checkConnectionDatabasesabium
        );
    }
}
