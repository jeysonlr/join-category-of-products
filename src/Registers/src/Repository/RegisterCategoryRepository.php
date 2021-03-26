<?php

declare(strict_types=1);

namespace Registers\Repository;

use Exception;
use Http\StatusHttp;
use ApiCore\Exception\Config;
use Doctrine\ORM\EntityRepository;
use Registers\Entity\RegisterCategory;
use Registers\Exception\RegisterCategoryDatabaseException;

class RegisterCategoryRepository extends EntityRepository implements RegisterCategoryRepositoryInterface
{
    /**
     * @param RegisterCategory $registerCategory
     *
     * @return RegisterCategory
     * @throws RegisterCategoryDatabaseException
     */
    public function insert(RegisterCategory $registerCategory): RegisterCategory
    {
        try {
            $this->getEntityManager()->persist($registerCategory);
            $this->getEntityManager()->flush();
            return $registerCategory;
        } catch (Exception $e) {
            throw new RegisterCategoryDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao inserir categoria!")
                    ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    ->setTraceError($e->getMessage())
            );
        }
    }

    /**
     * @param RegisterCategory $registerCategory
     *
     * @return RegisterCategory
     * @throws RegisterCategoryDatabaseException
     */
    public function update(RegisterCategory $registerCategory): RegisterCategory
    {
        try {
            $this->getEntityManager()->merge($registerCategory);
            $this->getEntityManager()->flush();
            return $registerCategory;
        } catch (Exception $e) {
            throw new RegisterCategoryDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao atualizar categoria!")
                    ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    ->setTraceError($e->getMessage())
            );
        }
    }

    /**
     * @param int $categoryId
     * @return object|RegisterCategory|null
     * @throws RegisterCategoryDatabaseException
     */
    public function findCategoryById(int $categoryId): ?RegisterCategory
    {
        try {
            return $this->findOneBy(['id_categoria_planejamento' => $categoryId]);
        } catch (Exception $e) {
            throw new RegisterCategoryDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao buscar categoria por id!")
                    ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    ->setTraceError($e->getMessage())
            );
        }
    }

    /**
     * @return array|null
     * @throws RegisterCategoryDatabaseException
     */
    public function findAllCategorys(): ?array
    {
        try {
            return $this->findAll();
        } catch (Exception $e) {
            throw new RegisterCategoryDatabaseException(
                (new Config())
                    ->setMessageError("Erro ao buscar todas categorias!")
                    ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    ->setTraceError($e->getMessage())
            );
        }
    }
}