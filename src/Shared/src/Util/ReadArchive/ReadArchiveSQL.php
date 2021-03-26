<?php

declare(strict_types=1);

namespace Shared\Util\ReadArchive;

use Exception;
use Http\StatusHttp;
use ApiCore\Exception\Config;
use Shared\Exception\SQLFileNotFoundException;

class ReadArchiveSQL extends ReadArchive
{
    const PATH = "/../../../../../data/SQL/DML/";

    /**
     * Faz a leitura de um arquivo SQL
     * @param string $folder
     * @param string $fileName
     * @return false|string
     * @throws SQLFileNotFoundException
     */
    public function readArchive(string $folder, string $fileName)
    {
        try {
            return $this->openFile(self::PATH . $folder . "/" . $fileName . ".sql");
        } catch (Exception $e) {
            throw new SQLFileNotFoundException(
                (new Config())
                    ->setStatusCode(StatusHttp::NOT_FOUND)
                    ->setMessageError("Ocorreu um erro ao buscar arquivo de SQL")
            );
        }
    }
}
