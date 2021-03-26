<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Registers\Entity\RegisterProduct;

class DeleteRegisterProductServiceFactory
{
    public function __invoke(ContainerInterface $container): DeleteRegisterProductService
    {
        $entityManager = $container->get(EntityManager::class);
        $registerRepository = $entityManager->getRepository(RegisterProduct::class);
        $getRegisterProductService = $container->get(GetRegisterProductService::class);
        return new DeleteRegisterProductService(
            $registerRepository,
            $getRegisterProductService
        );
    }
}
