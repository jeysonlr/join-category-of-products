<?php

declare(strict_types=1);

namespace Shared\Util;

use stdClass;

abstract class FormatterUTF8
{
    /**
     * @param $data
     * @return string
     */
    public static function encodeInUtf8($data): string
    {
        if (is_string($data)) {
            $data = json_decode($data, false, 512, JSON_UNESCAPED_UNICODE);
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $data
     * @return stdClass|null
     */
    public static function decodeInUtf8(string $data): ?stdClass
    {
        if (empty($data)) {
            return null;
        }
        return json_decode($data, false, 512, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string|null $data
     * @return bool
     */
    public static function isUtf8(?string $data): bool
    {
        return (!empty($data)) && (mb_detect_encoding($data, "utf-8", true) === false);
    }
}
