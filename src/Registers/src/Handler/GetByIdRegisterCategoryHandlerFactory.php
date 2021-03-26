<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterCategory\GetRegisterCategoryService;

class GetByIdRegisterCategoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetByIdRegisterCategoryHandler
    {
        $getRegisterCategoryService = $container->get(GetRegisterCategoryService::class);
        return new GetByIdRegisterCategoryHandler(
            $getRegisterCategoryService
        );
    }
}
