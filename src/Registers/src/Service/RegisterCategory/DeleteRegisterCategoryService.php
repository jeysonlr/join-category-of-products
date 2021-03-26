<?php

declare(strict_types=1);

namespace Registers\Service\RegisterCategory;

use Http\StatusHttp;
use ApiCore\Exception\Config;
use Doctrine\ORM\EntityManager;
use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterNotExistsException;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Exception\RegisterCategoryDatabaseException;
use Registers\Repository\RegisterCategoryRepositoryInterface;
use Registers\Service\RegisterProduct\GetRegisterProductServiceInterface;
use Registers\Service\RegisterProduct\DeleteRegisterProductServiceInterface;

class DeleteRegisterCategoryService implements DeleteRegisterCategoryServiceInterface
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @var RegisterCategoryRepositoryInterface
     */
    private RegisterCategoryRepositoryInterface $registerCategoryRepository;

    /**
     * @var GetRegisterCategoryServiceInterface
     */
    private GetRegisterCategoryServiceInterface $getRegisterCategoryService;

    /**
     * @var GetRegisterProductServiceInterface
     */
    private GetRegisterProductServiceInterface $getRegisterProductService;

    /**
     * @var DeleteRegisterProductServiceInterface
     */
    private DeleteRegisterProductServiceInterface $deleteRegisterProductService;

    public function __construct(
        EntityManager $entityManager,
        RegisterCategoryRepositoryInterface $registerCategoryRepository,
        GetRegisterCategoryServiceInterface $getRegisterCategoryService,
        GetRegisterProductServiceInterface $getRegisterProductService,
        DeleteRegisterProductServiceInterface $deleteRegisterProductService
    ) {
        $this->entityManager = $entityManager;
        $this->registerCategoryRepository = $registerCategoryRepository;
        $this->getRegisterCategoryService = $getRegisterCategoryService;
        $this->getRegisterProductService = $getRegisterProductService;
        $this->deleteRegisterProductService = $deleteRegisterProductService;
    }

    /**
     * @param int $categoryId
     * @throws RegisterCategoryDatabaseException
     * @throws RegisterNotExistsException
     * @throws RegisterProductDatabaseException
     */
    public function deleteCategory(int $categoryId): void
    {
        $registerCategory = $this->getRegisterCategoryService->getCategoryById($categoryId);
        if ($registerCategory) {

            $products = $this->getRegisterProductService->getProductByIdCategory($categoryId);

            foreach ($products as $value) {
                $this->entityManager->beginTransaction();

                /* @var RegisterProduct $value */
                $this->deleteRegisterProductService->deleteProduct($value->getIdProduto());

                $this->entityManager->commit();
            }

            $this->registerCategoryRepository->delete($registerCategory);
        } else {
            throw new RegisterNotExistsException(
                (new Config())
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
                    ->setMessageError("Categoria com o id {$categoryId} não existe")
            );
        }
    }
}
