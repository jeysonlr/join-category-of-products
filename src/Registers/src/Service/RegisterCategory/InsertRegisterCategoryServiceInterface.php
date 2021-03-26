<?php

declare(strict_types=1);

namespace Registers\Service\RegisterCategory;

use Registers\Entity\RegisterCategory;
use Registers\Exception\RegisterCategoryDatabaseException;

interface InsertRegisterCategoryServiceInterface
{
    /**
     * @param RegisterCategory $registerCategory
     * @return RegisterCategory
     * @throws RegisterCategoryDatabaseException
     */
    public function insertCategory(RegisterCategory $registerCategory): RegisterCategory;
}
