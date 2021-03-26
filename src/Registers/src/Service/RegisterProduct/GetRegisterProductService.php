<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Repository\RegisterProductRepositoryInterface;

class GetRegisterProductService implements GetRegisterProductServiceInterface
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
     * @param int $productId
     * @return RegisterProduct|null
     * @throws RegisterProductDatabaseException
     */
    public function getProductById(int $productId): ?RegisterProduct
    {
        return $this->registerProductRepository->findProductById($productId);
    }

    /**
     * @return array|null
     * @throws RegisterProductDatabaseException
     */
    public function getAllProducts(): ?array
    {
        return $this->registerProductRepository->findAllProducts();
    }
}
