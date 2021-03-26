<?php

declare(strict_types=1);

namespace Infrastructure\Service\DatabaseSabium;

interface SabiumDatabaseConnectionCheckServiceInterface
{
    /**
     * @return void
     */
    public function checkConnectionDatabaseSabium(): void;
}
