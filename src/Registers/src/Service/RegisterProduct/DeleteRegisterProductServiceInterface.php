<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Registers\Exception\RegisterNotExistsException;
use Registers\Exception\RegisterProductDatabaseException;

interface DeleteRegisterProductServiceInterface
{
    /**
     * @param int $productId
     * @throws RegisterNotExistsException
     * @throws RegisterProductDatabaseException
     */
    public function deleteProduct(int $productId): void;
}
