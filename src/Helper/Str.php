<?php

declare(strict_types=1);

namespace App\Helper;

class Str
{
    public static function toSnakeCase(string $str): string
    {
        return strtolower(preg_replace('/\s+/', '_', $str));
    }

    public static function same(string $a, string $b): bool
    {
        return strcasecmp($a, $b) == 0;
    }
}
