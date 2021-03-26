<?php

declare(strict_types=1);

namespace Infrastructure\Util\LogCentralizer;

use ApiCore\LoadConfigData;

class Centralizer extends LoadConfigData
{
    /**
     * @return array
     */
    public static function getOptions(): array
    {
        return self::getConfig("sentry-options");
    }

    /**
     * @return string
     */
    public static function getEnvironment(): string
    {
        return self::getConfig("sentry-options", "environment");
    }
}