<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterProduct\DeleteRegisterProductService;

class DeleteRegisterProductHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeleteRegisterProductHandler
    {
        $deleteRegisterProductService = $container->get(DeleteRegisterProductService::class);
        return new DeleteRegisterProductHandler(
            $deleteRegisterProductService
        );
    }
}
