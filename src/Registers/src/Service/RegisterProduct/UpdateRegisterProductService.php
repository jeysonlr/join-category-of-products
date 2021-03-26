<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Repository\RegisterProductRepositoryInterface;

class UpdateRegisterProductService implements UpdateRegisterProductServiceInterface
{
    /**
     * @var RegisterProductRepositoryInterface
     */
    private RegisterProductRepositoryInterface $registerProductRepository;

    public function __construct(
        RegisterProductRepositoryInterface $registerProductRepository
    ) {
        $this->registerProductRepository = $registerProductRepository;
    }

    /**
     * @param RegisterProduct $registerCategory
     * @return RegisterProduct
     * @throws RegisterProductDatabaseException
     */
    public function updateProduct(RegisterProduct $registerCategory): RegisterProduct
    {
        return $this->registerProductRepository->update($registerCategory);
    }
}
