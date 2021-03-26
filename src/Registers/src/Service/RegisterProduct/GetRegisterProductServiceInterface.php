<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterProductDatabaseException;

interface GetRegisterProductServiceInterface
{
    /**
     * @param int $productId
     * @return RegisterProduct|null
     * @throws RegisterProductDatabaseException
     */
    public function getProductById(int $productId): ?RegisterProduct;

    /**
     * @param int $categoryId
     * @return array|null
     */
    public function getProductByIdCategory(int $categoryId): ?array;

    /**
     * @return array|null
     * @throws RegisterProductDatabaseException
     */
    public function getAllProducts(): ?array;
}
