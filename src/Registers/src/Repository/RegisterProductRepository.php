<?php

declare(strict_types=1);

namespace Registers\Repository;

use Exception;
use Http\StatusHttp;
use ApiCore\Exception\Config;
use Doctrine\ORM\EntityRepository;
use Registers\Entity\RegisterProduct;
use Registers\Exception\RegisterProductDatabaseException;

class RegisterProductRepository extends EntityRepository implements RegisterProductRepositoryInterface
{
    /**
     * @param RegisterProduct $registerProduct
     *
     * @return RegisterProduct
     * @throws RegisterProductDatabaseException
     */
    public function insert(RegisterProduct $registerProduct): RegisterProduct
    {
        try {
            $this->getEntityManager()->persist($registerProduct);
            $this->getEntityManager()->flush();
            return $registerProduct;
        } catch (Exception $e) {
            throw new RegisterProductDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao inserir produto!")
                    ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    ->setTraceError($e->getMessage())
            );
        }
    }

    /**
     * @param RegisterProduct $registerProduct
     *
     * @return RegisterProduct
     * @throws RegisterProductDatabaseException
     */
    public function update(RegisterProduct $registerProduct): RegisterProduct
    {
        try {
            $this->getEntityManager()->merge($registerProduct);
            $this->getEntityManager()->flush();
            return $registerProduct;
        } catch (Exception $e) {
            throw new RegisterProductDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao atualizar produto!")
                    ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    ->setTraceError($e->getMessage())
            );
        }
    }

    /**
     * @param int $productId
     * @return object|RegisterProduct|null
     * @throws RegisterProductDatabaseException
     */
    public function findProductById(int $productId): ?RegisterProduct
    {
        try {
            return $this->findOneBy(['id_produto' => $productId]);
        } catch (Exception $e) {
            throw new RegisterProductDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao buscar produto por id!")
                    ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    ->setTraceError($e->getMessage())
            );
        }
    }

    /**
     * @return array|null
     * @throws RegisterProductDatabaseException
     */
    public function findAllProducts(): ?array
    {
        try {
            return $this->findAll();
        } catch (Exception $e) {
            throw new RegisterProductDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao buscar todos produtos!")
                    ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    ->setTraceError($e->getMessage())
            );
        }
    }
}