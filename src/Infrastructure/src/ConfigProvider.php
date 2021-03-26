<?php

declare(strict_types=1);

namespace Infrastructure;

use Doctrine\ORM\EntityManager;
use Infrastructure\Container\MonologFactory;
use Roave\PsrContainerDoctrine\EntityManagerFactory;
use Infrastructure\Middleware\ErrorHandlerMiddleware;
use Infrastructure\Middleware\ErrorHandlerMiddlewareFactory;
use Infrastructure\Middleware\RequestLog\LogRequestMiddleware;
use Infrastructure\Middleware\RequestLog\LogRequestMiddlewareFactory;
use Infrastructure\Service\DatabaseSabium\SabiumDatabaseConnectionCheckService;
use Infrastructure\Middleware\ConnectionExternal\CheckConnectionsExternalMiddleware;
use Infrastructure\Service\DatabaseSabium\SabiumDatabaseConnectionCheckServiceFactory;
use Infrastructure\Middleware\ConnectionExternal\CheckConnectionsExternalMiddlewareFactory;

/**
 * The configuration provider for the Infrastructure module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [],
            'factories'  => [
                # Container
                MonologFactory::class => MonologFactory::class,
                EntityManager::class => EntityManagerFactory::class,

                # Middleware
                LogRequestMiddleware::class => LogRequestMiddlewareFactory::class,
                CheckConnectionsExternalMiddleware::class => CheckConnectionsExternalMiddlewareFactory::class,
                ErrorHandlerMiddleware::class => ErrorHandlerMiddlewareFactory::class,

                # Service
                SabiumDatabaseConnectionCheckService::class => SabiumDatabaseConnectionCheckServiceFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'infrastructure'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
