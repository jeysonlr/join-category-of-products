<?php

declare(strict_types=1);

namespace Shared\Util;

class SmallintToBoolean
{
    public static function convert(int $number): bool
    {
        if ($number <= 0) {
            return false;
        }

        return true;
    }
}
