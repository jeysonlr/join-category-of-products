<?php

declare(strict_types=1);

namespace Registers;

use Mezzio\Application;
use Registers\Handler\PutRegisterProductHandler;
use Registers\Handler\PostRegisterProductHandler;
use Registers\Handler\PutRegisterCategoryHandler;
use Registers\Handler\PostRegisterCategoryHandler;
use Registers\Handler\DeleteRegisterProductHandler;
use Registers\Handler\GetAllRegisterProductHandler;
use Registers\Handler\GetAllRegisterCategoryHandler;
use Registers\Handler\GetByIdRegisterProductHandler;
use Registers\Handler\GetByIdRegisterCategoryHandler;
use Registers\Handler\PutRegisterProductHandlerFactory;
use Registers\Handler\PostRegisterProductHandlerFactory;
use Registers\Handler\PutRegisterCategoryHandlerFactory;
use Registers\Handler\PostRegisterCategoryHandlerFactory;
use Registers\Handler\DeleteRegisterProductHandlerFactory;
use Registers\Handler\GetAllRegisterProductHandlerFactory;
use Registers\Handler\GetByIdRegisterProductHandlerFactory;
use Registers\Handler\GetAllRegisterCategoryHandlerFactory;
use Registers\Handler\GetByIdRegisterCategoryHandlerFactory;
use Registers\Service\RegisterProduct\GetRegisterProductService;
use Registers\Service\RegisterCategory\GetRegisterCategoryService;
use Registers\Service\RegisterProduct\DeleteRegisterProductService;
use Registers\Service\RegisterProduct\InsertRegisterProductService;
use Registers\Service\RegisterProduct\UpdateRegisterProductService;
use Registers\Service\RegisterCategory\DeleteRegisterCategoryService;
use Registers\Service\RegisterCategory\InsertRegisterCategoryService;
use Registers\Service\RegisterCategory\UpdateRegisterCategoryService;
use Registers\Middleware\RegisterProduct\PutRegisterProductMiddleware;
use Registers\Middleware\RegisterProduct\PostRegisterProductMiddleware;
use Registers\Service\RegisterProduct\GetRegisterProductServiceFactory;
use Registers\Middleware\RegisterCategory\PutRegisterCategoryMiddleware;
use Registers\Middleware\RegisterCategory\PostRegisterCategoryMiddleware;
use Registers\Service\RegisterCategory\GetRegisterCategoryServiceFactory;
use Registers\Service\RegisterProduct\DeleteRegisterProductServiceFactory;
use Registers\Service\RegisterProduct\InsertRegisterProductServiceFactory;
use Registers\Service\RegisterProduct\UpdateRegisterProductServiceFactory;
use Registers\Service\RegisterCategory\DeleteRegisterCategoryServiceFactory;
use Registers\Service\RegisterCategory\InsertRegisterCategoryServiceFactory;
use Registers\Service\RegisterCategory\UpdateRegisterCategoryServiceFactory;
use Registers\Middleware\RegisterProduct\PutRegisterProductMiddlewareFactory;
use Registers\Middleware\RegisterProduct\PostRegisterProductMiddlewareFactory;
use Registers\Middleware\RegisterCategory\PutRegisterCategoryMiddlewareFactory;
use Registers\Middleware\RegisterCategory\PostRegisterCategoryMiddlewareFactory;

/**
 * The configuration provider for the Registers module
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
            'delegators' => [
                Application::class => [RoutesDelegator::class],
            ],
            'invokables' => [
            ],
            'factories'  => [
                # RegisterCategory
                GetRegisterCategoryService::class => GetRegisterCategoryServiceFactory::class,
                InsertRegisterCategoryService::class => InsertRegisterCategoryServiceFactory::class,
                UpdateRegisterCategoryService::class => UpdateRegisterCategoryServiceFactory::class,
                DeleteRegisterCategoryService::class => DeleteRegisterCategoryServiceFactory::class,

                GetAllRegisterCategoryHandler::class => GetAllRegisterCategoryHandlerFactory::class,
                GetByIdRegisterCategoryHandler::class => GetByIdRegisterCategoryHandlerFactory::class,
                PostRegisterCategoryHandler::class => PostRegisterCategoryHandlerFactory::class,
                PutRegisterCategoryHandler::class => PutRegisterCategoryHandlerFactory::class,

                PostRegisterCategoryMiddleware::class => PostRegisterCategoryMiddlewareFactory::class,
                PutRegisterCategoryMiddleware::class => PutRegisterCategoryMiddlewareFactory::class,


                # RegisterProduct
                GetRegisterProductService::class => GetRegisterProductServiceFactory::class,
                InsertRegisterProductService::class => InsertRegisterProductServiceFactory::class,
                UpdateRegisterProductService::class => UpdateRegisterProductServiceFactory::class,
                DeleteRegisterProductService::class => DeleteRegisterProductServiceFactory::class,

                GetAllRegisterProductHandler::class => GetAllRegisterProductHandlerFactory::class,
                GetByIdRegisterProductHandler::class => GetByIdRegisterProductHandlerFactory::class,
                PostRegisterProductHandler::class => PostRegisterProductHandlerFactory::class,
                PutRegisterProductHandler::class => PutRegisterProductHandlerFactory::class,
                DeleteRegisterProductHandler::class => DeleteRegisterProductHandlerFactory::class,

                PostRegisterProductMiddleware::class => PostRegisterProductMiddlewareFactory::class,
                PutRegisterProductMiddleware::class => PutRegisterProductMiddlewareFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'registers'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
