<?php

declare(strict_types=1);

namespace Registers\Service\RegisterCategory;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Registers\Entity\RegisterCategory;
use Registers\Service\RegisterProduct\GetRegisterProductService;
use Registers\Service\RegisterProduct\DeleteRegisterProductService;

class DeleteRegisterCategoryServiceFactory
{
    public function __invoke(ContainerInterface $container): DeleteRegisterCategoryService
    {
        $entityManager = $container->get(EntityManager::class);
        $registerRepository = $entityManager->getRepository(RegisterCategory::class);
        $getRegisterCategoryService = $container->get(GetRegisterCategoryService::class);
        $getRegisterProductService = $container->get(GetRegisterProductService::class);
        $deleteRegisterProductService = $container->get(DeleteRegisterProductService::class);
        return new DeleteRegisterCategoryService(
            $entityManager,
            $registerRepository,
            $getRegisterCategoryService,
            $getRegisterProductService,
            $deleteRegisterProductService
        );
    }
}
