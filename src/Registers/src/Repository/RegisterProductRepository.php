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
     * @param RegisterProduct $registerProduct
     * @throws RegisterProductDatabaseException
     */
    public function delete(RegisterProduct $registerProduct): void
    {
        try {
            $this->getEntityManager()->merge($registerProduct);
            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            throw new RegisterProductDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao deletar produto!")
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
     * @param int $categoryId
     * @return array|null
     * @throws RegisterProductDatabaseException
     */
    public function findProductByIdCategory(int $categoryId): ?array
    {
        try {
            return $this->findBy(['id_categoria_planejamento' => $categoryId]);
        } catch (Exception $e) {
            throw new RegisterProductDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao buscar categoria de produto por id!")
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