<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterProduct\InsertRegisterProductService;

class PostRegisterProductHandlerFactory
{
    public function __invoke(ContainerInterface $container): PostRegisterProductHandler
    {
        $insertRegisterCategoryService = $container->get(InsertRegisterProductService::class);
        return new PostRegisterProductHandler(
            $insertRegisterCategoryService
        );
    }
}
