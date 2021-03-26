<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Repository\RegisterProductRepositoryInterface;

class InsertRegisterProductService implements InsertRegisterProductServiceInterface
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
     * @param RegisterProduct $registerProduct
     * @return RegisterProduct
     * @throws RegisterProductDatabaseException
     */
    public function insertProduct(RegisterProduct $registerProduct): RegisterProduct
    {
        $this->registerProductRepository->insert($registerProduct);
    }
}
