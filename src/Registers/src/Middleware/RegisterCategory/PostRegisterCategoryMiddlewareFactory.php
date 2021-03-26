<?php

declare(strict_types=1);

namespace Registers\Middleware\RegisterCategory;

use Shared\Util\SerializerUtil;
use Psr\Container\ContainerInterface;
use Shared\Service\Validation\ObjectValidationService;
use Registers\Service\RegisterCategory\GetRegisterCategoryService;

class PostRegisterCategoryMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PostRegisterCategoryMiddleware
    {
        $serializerUtil = $container->get(SerializerUtil::class);
        $objectValidationService = $container->get(ObjectValidationService::class);
        return new PostRegisterCategoryMiddleware(
            $serializerUtil,
            $objectValidationService
        );
    }
}
