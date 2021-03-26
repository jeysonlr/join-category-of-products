<?php

declare(strict_types=1);

namespace Registers\Service\RegisterCategory;

use Registers\Entity\RegisterCategory;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Repository\RegisterCategoryRepositoryInterface;

class UpdateRegisterCategoryService
{
    /**
     * @var RegisterCategoryRepositoryInterface
     */
    private RegisterCategoryRepositoryInterface $registerCategoryRepository;

    public function __construct(
        RegisterCategoryRepositoryInterface $registerCategoryRepository
    ) {
        $this->registerCategoryRepository = $registerCategoryRepository;
    }

    /**
     * @param RegisterCategory $registerCategory
     * @return RegisterCategory
     * @throws RegisterCategoryDatabaseException
     */
    public function updateCategory(RegisterCategory $registerCategory): RegisterCategory
    {
        return $this->registerCategoryRepository->update($registerCategory);
    }
}
