<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterCategory\UpdateRegisterCategoryService;

class PutRegisterCategoryHandlerFactory
{

    public function __invoke(ContainerInterface $container): PutRegisterCategoryHandler
    {
        $insertRegisterCategoryService = $container->get(UpdateRegisterCategoryService::class);
        return new PutRegisterCategoryHandler(
            $insertRegisterCategoryService
        );
    }
}
