<?php

declare(strict_types=1);

namespace Registers\Repository;

use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterProductDatabaseException;

interface RegisterProductRepositoryInterface
{
    /**
     * @param RegisterProduct $registerProduct
     *
     * @return RegisterProduct
     * @throws RegisterProductDatabaseException
     */
    public function insert(RegisterProduct $registerProduct): RegisterProduct;

    /**
     * @param RegisterProduct $registerProduct
     *
     * @return RegisterProduct
     * @throws RegisterProductDatabaseException
     */
    public function update(RegisterProduct $registerProduct): RegisterProduct;

    /**
     * @param int $productId
     * @return object|RegisterProduct|null
     * @throws RegisterProductDatabaseException
     */
    public function findProductById(int $productId): ?RegisterProduct;

    /**
     * @return array|null
     * @throws RegisterProductDatabaseException
     */
    public function findAllProducts(): ?array;
}
