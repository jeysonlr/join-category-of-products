<?php

declare(strict_types=1);

namespace Registers\Service\RegisterCategory;

use Registers\Entity\RegisterCategory;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Repository\RegisterCategoryRepositoryInterface;

class GetRegisterCategoryService implements GetRegisterCategoryServiceInterface
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
     * @param int $categoryId
     * @return RegisterCategory|null
     * @throws RegisterCategoryDatabaseException
     */
    public function getCategoryById(int $categoryId): ?RegisterCategory
    {
        return $this->registerCategoryRepository->findCategoryById($categoryId);
    }

    /**
     * @return array|null
     * @throws RegisterCategoryDatabaseException
     */
    public function getAllCategorys(): ?array
    {
        return $this->registerCategoryRepository->findAllCategorys();
    }
}
