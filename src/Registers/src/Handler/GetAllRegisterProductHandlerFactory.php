<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterProduct\GetRegisterProductService;

class GetAllRegisterProductHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetAllRegisterProductHandler
    {
        $getRegisterCategoryService = $container->get(GetRegisterProductService::class);
        return new GetAllRegisterProductHandler(
            $getRegisterCategoryService
        );
    }
}
