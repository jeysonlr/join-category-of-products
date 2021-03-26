<?php

declare(strict_types=1);

namespace Registers\Service\RegisterCategory;

use Registers\Exception\RegisterNotExistsException;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Exception\RegisterProductDatabaseException;

interface DeleteRegisterCategoryServiceInterface
{
    /**
     * @param int $categoryId
     * @throws RegisterCategoryDatabaseException
     * @throws RegisterNotExistsException
     * @throws RegisterProductDatabaseException
     */
    public function deleteCategory(int $categoryId): void;
}
