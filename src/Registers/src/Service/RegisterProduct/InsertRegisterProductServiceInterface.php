<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterProductDatabaseException;

interface InsertRegisterProductServiceInterface
{
    /**
     * @param RegisterProduct $registerProduct
     * @return RegisterProduct
     * @throws RegisterProductDatabaseException
     */
    public function insertProduct(RegisterProduct $registerProduct): RegisterProduct;
}
