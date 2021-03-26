<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterProductDatabaseException;

interface UpdateRegisterProductServiceInterface
{
    /**
     * @param RegisterProduct $registerProduct
     * @return RegisterProduct
     * @throws RegisterProductDatabaseException
     */
    public function updateProduct(RegisterProduct $registerProduct): RegisterProduct;
}
