<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterCategory\GetRegisterCategoryService;

class GetAllRegisterCategoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetAllRegisterCategoryHandler
    {
        $getRegisterCategoryService = $container->get(GetRegisterCategoryService::class);
        return new GetAllRegisterCategoryHandler(
            $getRegisterCategoryService
        );
    }
}
