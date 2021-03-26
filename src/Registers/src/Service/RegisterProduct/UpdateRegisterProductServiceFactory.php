<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Registers\Entity\RegisterProduct;

class UpdateRegisterProductServiceFactory
{
    public function __invoke(ContainerInterface $container): UpdateRegisterProductService
    {
        $entityManager = $container->get(EntityManager::class);
        $registerRepository = $entityManager->getRepository(RegisterProduct::class);
        return new UpdateRegisterProductService(
            $registerRepository
        );
    }
}
