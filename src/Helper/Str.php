<?php

declare(strict_types=1);

namespace App\Helper;

class Str
{
    public static function toSnakeCase(string $str): string
    {
        return strtolower(preg_replace('/\s+/', '_', $str));
    }
}
