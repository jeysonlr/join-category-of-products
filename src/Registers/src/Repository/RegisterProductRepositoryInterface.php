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
     * @param RegisterProduct $registerProduct
     * @throws RegisterProductDatabaseException
     */
    public function delete(RegisterProduct $registerProduct): void;

    /**
     * @param int $productId
     * @return object|RegisterProduct|null
     * @throws RegisterProductDatabaseException
     */
    public function findProductById(int $productId): ?RegisterProduct;

    /**
     * @param int $categoryId
     * @return array|null
     * @throws RegisterProductDatabaseException
     */
    public function findProductByIdCategory(int $categoryId): ?array;

    /**
     * @return array|null
     * @throws RegisterProductDatabaseException
     */
    public function findAllProducts(): ?array;
}
