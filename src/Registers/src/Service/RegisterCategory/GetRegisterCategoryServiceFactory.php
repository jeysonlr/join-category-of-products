<?php

declare(strict_types=1);

namespace Registers\Service\RegisterCategory;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Registers\Entity\RegisterCategory;

class GetRegisterCategoryServiceFactory
{
    public function __invoke(ContainerInterface $container): GetRegisterCategoryService
    {
        $entityManager = $container->get(EntityManager::class);
        $registerRepository = $entityManager->getRepository(RegisterCategory::class);
        return new GetRegisterCategoryService(
            $registerRepository
        );
    }
}
