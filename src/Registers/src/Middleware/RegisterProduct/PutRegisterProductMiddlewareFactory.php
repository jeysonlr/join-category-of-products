<?php

declare(strict_types=1);

namespace Registers\Middleware\RegisterProduct;

use Shared\Util\SerializerUtil;
use Psr\Container\ContainerInterface;
use Shared\Service\Validation\ObjectValidationService;
use Registers\Service\RegisterProduct\GetRegisterProductService;

class PutRegisterProductMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PutRegisterProductMiddleware
    {
        $serializerUtil = $container->get(SerializerUtil::class);
        $objectValidationService = $container->get(ObjectValidationService::class);
        $getRegisterProductService = $container->get(GetRegisterProductService::class);
        return new PutRegisterProductMiddleware(
            $serializerUtil,
            $objectValidationService,
            $getRegisterProductService
        );
    }
}
