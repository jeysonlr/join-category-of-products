<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Registers\Entity\RegisterProduct;

class InsertRegisterProductServiceFactory
{
    public function __invoke(ContainerInterface $container): InsertRegisterProductService
    {
        $entityManager = $container->get(EntityManager::class);
        $registerRepository = $entityManager->getRepository(RegisterProduct::class);
        return new InsertRegisterProductService(
            $registerRepository
        );
    }
}
