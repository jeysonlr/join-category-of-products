<?php

declare(strict_types=1);

namespace Infrastructure\Service\CheckDatabase;

use Exception;
use Http\StatusHttp;
use ApiCore\Exception\Config;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Infrastructure\Exception\SabiumDatabaseConnectionException;

class DatabaseConnectionCheckService implements DatabaseConnectionCheckServiceInterface
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @throws SabiumDatabaseConnectionException
     */
    public function checkConnectionDatabase(): void
    {
        try {
            $this->container->get(EntityManager::class);
        } catch (Exception $e) {
            throw new SabiumDatabaseConnectionException(
                (new Config())
                    ->setMessageError("Erro ao conectar com o banco de dados!")
                    ->setStatusCode(StatusHttp::BAD_REQUEST)
            );
        }
    }
}
