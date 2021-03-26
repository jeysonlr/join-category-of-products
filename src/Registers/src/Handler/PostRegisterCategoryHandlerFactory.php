<?php

declare(strict_types=1);

namespace Registers\Handler;

use Psr\Container\ContainerInterface;
use Registers\Service\RegisterCategory\InsertRegisterCategoryService;

class PostRegisterCategoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): PostRegisterCategoryHandler
    {
        $insertRegisterCategoryService = $container->get(InsertRegisterCategoryService::class);
        return new PostRegisterCategoryHandler(
            $insertRegisterCategoryService
        );
    }
}
