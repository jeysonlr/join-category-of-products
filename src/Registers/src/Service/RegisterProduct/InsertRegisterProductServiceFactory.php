<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Registers\Entity\RegisterCategory;

class InsertRegisterProductServiceFactory
{
    public function __invoke(ContainerInterface $container): InsertRegisterProductService
    {
        $entityManager = $container->get(EntityManager::class);
        $registerRepository = $entityManager->getRepository(RegisterCategory::class);
        return new InsertRegisterProductService(
            $registerRepository
        );
    }
}
