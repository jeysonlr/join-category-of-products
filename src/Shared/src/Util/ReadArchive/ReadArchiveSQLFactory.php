<?php

declare(strict_types=1);

namespace Shared\Util\ReadArchive;

use Psr\Container\ContainerInterface;

class ReadArchiveSQLFactory
{
    public function __invoke(ContainerInterface $container): ReadArchiveSQL
    {
        return new ReadArchiveSQL();
    }
}
