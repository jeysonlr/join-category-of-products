<?php

declare(strict_types=1);

namespace Shared;

use Shared\Util\SerializerUtil;
use Shared\Container\JMSFactory;
use Shared\Util\SerializerUtilFactory;
use Shared\Util\ReadArchive\ReadArchiveSQL;
use Shared\Middleware\LoadConfigDataMiddleware;
use Shared\Util\ReadArchive\ReadArchiveSQLFactory;
use Shared\Middleware\LoadConfigDataMiddlewareFactory;
use Shared\Service\Validation\ObjectValidationService;
use Shared\Service\Validation\ObjectValidationServiceFactory;

/**
 * The configuration provider for the Shared module
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
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                # Middleware
                LoadConfigDataMiddleware::class => LoadConfigDataMiddlewareFactory::class,

                # Service
                    # Validation
                    ObjectValidationService::class => ObjectValidationServiceFactory::class,

                # Util
                'serializer' => JMSFactory::class,
                SerializerUtil::class => SerializerUtilFactory::class,
                ReadArchiveSQL::class => ReadArchiveSQLFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [],
        ];
    }
}
