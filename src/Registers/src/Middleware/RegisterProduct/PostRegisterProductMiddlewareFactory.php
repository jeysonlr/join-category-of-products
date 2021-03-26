<?php

declare(strict_types=1);

namespace Registers\Middleware\RegisterProduct;

use Shared\Util\SerializerUtil;
use Psr\Container\ContainerInterface;
use Shared\Service\Validation\ObjectValidationService;
use Registers\Service\RegisterCategory\GetRegisterCategoryService;

class PostRegisterProductMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PostRegisterProductMiddleware
    {
        $serializerUtil = $container->get(SerializerUtil::class);
        $objectValidationService = $container->get(ObjectValidationService::class);
        $getRegisterCategoryService = $container->get(GetRegisterCategoryService::class);
        return new PostRegisterProductMiddleware(
            $serializerUtil,
            $objectValidationService,
            $getRegisterCategoryService
        );
    }
}
