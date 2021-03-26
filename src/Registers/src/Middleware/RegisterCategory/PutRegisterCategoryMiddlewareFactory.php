<?php

declare(strict_types=1);

namespace Registers\Middleware\RegisterCategory;

use Shared\Util\SerializerUtil;
use Psr\Container\ContainerInterface;
use Shared\Service\Validation\ObjectValidationService;
use Registers\Service\RegisterCategory\GetRegisterCategoryService;

class PutRegisterCategoryMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PutRegisterCategoryMiddleware
    {
        $serializerUtil = $container->get(SerializerUtil::class);
        $objectValidationService = $container->get(ObjectValidationService::class);
        $getRegisterCategoryService = $container->get(GetRegisterCategoryService::class);
        return new PutRegisterCategoryMiddleware(
            $serializerUtil,
            $objectValidationService,
            $getRegisterCategoryService
        );
    }
}
