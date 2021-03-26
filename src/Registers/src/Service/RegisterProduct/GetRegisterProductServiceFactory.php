<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Registers\Entity\RegisterProduct;

class GetRegisterProductServiceFactory
{
    public function __invoke(ContainerInterface $container): GetRegisterProductService
    {
        $entityManager = $container->get(EntityManager::class);
        $registerRepository = $entityManager->getRepository(RegisterProduct::class);
        return new GetRegisterProductService(
            $registerRepository
        );
    }
}
