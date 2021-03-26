<?php

declare(strict_types=1);

namespace Registers\Repository;

use Registers\Entity\RegisterCategory;
use Registers\Exception\RegisterCategoryDatabaseException;

interface RegisterCategoryRepositoryInterface
{
    /**
     * @param RegisterCategory $registerCategory
     *
     * @return RegisterCategory
     * @throws RegisterCategoryDatabaseException
     */
    public function insert(RegisterCategory $registerCategory): RegisterCategory;

    /**
     * @param RegisterCategory $registerCategory
     *
     * @return RegisterCategory
     * @throws RegisterCategoryDatabaseException
     */
    public function update(RegisterCategory $registerCategory): RegisterCategory;

    /**
     * @param RegisterCategory $registerCategory
     * @throws RegisterCategoryDatabaseException
     */
    public function delete(RegisterCategory $registerCategory): void;

    /**
     * @param int $categoryId
     * @return object|RegisterCategory|null
     * @throws RegisterCategoryDatabaseException
     */
    public function findCategoryById(int $categoryId): ?RegisterCategory;

    /**
     * @return array|null
     * @throws RegisterCategoryDatabaseException
     */
    public function findAllCategorys(): ?array;
}