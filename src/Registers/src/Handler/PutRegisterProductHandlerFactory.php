<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterProduct\UpdateRegisterProductService;

class PutRegisterProductHandlerFactory
{

    public function __invoke(ContainerInterface $container): PutRegisterProductHandler
    {
        $insertRegisterCategoryService = $container->get(UpdateRegisterProductService::class);
        return new PutRegisterProductHandler(
            $insertRegisterCategoryService
        );
    }
}
