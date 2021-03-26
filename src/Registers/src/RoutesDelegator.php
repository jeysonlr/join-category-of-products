<?php

declare(strict_types=1);

namespace Registers;

use Mezzio\Application;
use Psr\Container\ContainerInterface;
use Registers\Handler\GetAllRegisterCategoryHandler;

class RoutesDelegator
{
    /**
     * @var Application
     */
    private Application $app;

    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): Application
    {
        $this->app = $callback();

        $this->app->get('/v1/registers/categorys', [
            GetAllRegisterCategoryHandler::class
        ], 'registers.get_all_categorys');
//
//        $this->app->put('/v1/products/price', [
//            UpdatePriceApiHandler::class
//        ], 'price.put_price_api');
//
//        $this->app->put('/v1/products/price/update', [
//            UpdatePriceAlreadySendPrecodeApiHandler::class
//        ], 'price.put_product_price_update');

        return $this->app;
    }
}
