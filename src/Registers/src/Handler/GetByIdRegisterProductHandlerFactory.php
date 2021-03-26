<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterProduct\GetRegisterProductService;

class GetByIdRegisterProductHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetByIdRegisterProductHandler
    {
        $getRegisterCategoryService = $container->get(GetRegisterProductService::class);
        return new GetByIdRegisterProductHandler(
            $getRegisterCategoryService
        );
    }
}
