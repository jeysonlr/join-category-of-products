<?php

declare(strict_types=1);

namespace Registers\Service\RegisterCategory;

use Registers\Entity\RegisterCategory;
use Registers\Exception\RegisterCategoryDatabaseException;

interface GetRegisterCategoryServiceInterface
{
    /**
     * @param int $categoryId
     * @return RegisterCategory|null
     * @throws RegisterCategoryDatabaseException
     */
    public function getCategoryById(int $categoryId): ?RegisterCategory;

    /**
     * @return array|null
     * @throws RegisterCategoryDatabaseException
     */
    public function getAllCategorys(): ?array;
}
