<?php

declare(strict_types=1);

namespace Registers;

use Mezzio\Application;
use Psr\Container\ContainerInterface;
use Registers\Handler\PutRegisterProductHandler;
use Registers\Handler\PutRegisterCategoryHandler;
use Registers\Handler\PostRegisterProductHandler;
use Registers\Handler\PostRegisterCategoryHandler;
use Registers\Handler\DeleteRegisterProductHandler;
use Registers\Handler\GetAllRegisterProductHandler;
use Registers\Handler\GetByIdRegisterProductHandler;
use Registers\Handler\GetAllRegisterCategoryHandler;
use Registers\Handler\GetByIdRegisterCategoryHandler;
use Registers\Middleware\RegisterProduct\PutRegisterProductMiddleware;
use Registers\Middleware\RegisterProduct\PostRegisterProductMiddleware;
use Registers\Middleware\RegisterCategory\PutRegisterCategoryMiddleware;
use Registers\Middleware\RegisterCategory\PostRegisterCategoryMiddleware;

class RoutesDelegator
{
    /**
     * @var Application
     */
    private Application $app;

    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): Application
    {
        $this->app = $callback();

        $this->app->post('/v1/registers/categorys', [
            PostRegisterCategoryMiddleware::class,
            PostRegisterCategoryHandler::class
        ], 'registers.post_categorys');

        $this->app->get('/v1/registers/categorys', [
            GetAllRegisterCategoryHandler::class
        ], 'registers.get_all_categorys');
       
        $this->app->get('/v1/registers/categorys/{id_categoria_planejamento:\d+}', [
            GetByIdRegisterCategoryHandler::class
        ], 'registers.get_by_id_categorys');

        $this->app->put('/v1/registers/categorys/{id_categoria_planejamento:\d+}', [
            PutRegisterCategoryMiddleware::class,
            PutRegisterCategoryHandler::class
        ], 'registers.put_by_id_categorys');


        $this->app->post('/v1/registers/products', [
            PostRegisterProductMiddleware::class,
            PostRegisterProductHandler::class
        ], 'registers.post_products');

        $this->app->get('/v1/registers/products', [
            GetAllRegisterProductHandler::class
        ], 'registers.get_all_products');
       
        $this->app->get('/v1/registers/products/{id_produto:\d+}', [
            GetByIdRegisterProductHandler::class
        ], 'registers.get_by_id_products');

        $this->app->put('/v1/registers/products/{id_produto:\d+}', [
            PutRegisterProductMiddleware::class,
            PutRegisterProductHandler::class
        ], 'registers.put_by_id_products');

        $this->app->delete('/v1/registers/products/{id_produto:\d+}', [
            DeleteRegisterProductHandler::class
        ], 'registers.delete_by_id_products');

        return $this->app;
    }
}
