<?php

declare(strict_types=1);

namespace Registers\Service\RegisterProduct;

use Http\StatusHttp;
use ApiCore\Exception\Config;
use Registers\Exception\RegisterNotExistsException;
use Registers\Exception\RegisterProductDatabaseException;
use Registers\Repository\RegisterProductRepositoryInterface;

class DeleteRegisterProductService implements DeleteRegisterProductServiceInterface
{
    /**
     * @var RegisterProductRepositoryInterface
     */
    private RegisterProductRepositoryInterface $registerProductRepository;

    /**
     * @var GetRegisterProductServiceInterface
     */
    private GetRegisterProductServiceInterface $getRegisterProductService;

    public function __construct(
        RegisterProductRepositoryInterface $registerProductRepository,
        GetRegisterProductServiceInterface $getRegisterProductService
    ) {
        $this->registerProductRepository = $registerProductRepository;
        $this->getRegisterProductService = $getRegisterProductService;
    }

    /**
     * @param int $productId
     * @throws RegisterNotExistsException
     * @throws RegisterProductDatabaseException
     */
    public function deleteProduct(int $productId): void
    {
        $registerCategory = $this->getRegisterProductService->getProductById($productId);
        if ($registerCategory) {
            $this->registerProductRepository->delete($registerCategory);
        } else {
            throw new RegisterNotExistsException(
                (new Config())
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
                    ->setMessageError("Categoria com o id {$productId} não existe")
            );
        }
    }
}
