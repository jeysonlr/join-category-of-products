<?php

declare(strict_types=1);

namespace Infrastructure\Service\CheckDatabase;

interface DatabaseConnectionCheckServiceInterface
{
    /**
     * @return void
     */
    public function checkConnectionDatabase(): void;
}
