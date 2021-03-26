<?php

declare(strict_types=1);

namespace Shared\Util\ReadArchive;

class ReadArchive
{
    /**
     * Busca/abre os arquivos com base no $fullPath
     * @param string $fullPath
     * @return false|string
     */
    protected function openFile(string $fullPath)
    {
        return file_get_contents(__DIR__ . $fullPath);
    }
}
