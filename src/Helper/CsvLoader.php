<?php

declare(strict_types=1);

namespace App\Helper;

class CsvLoader
{
    public static function loadToAssocArray(string $filePath): array
    {
        $data = [];
        if (false === $file = @file($filePath)) {
            return $data;
        }

        $rows   = array_map('str_getcsv', $file);
        $header = array_map(function ($header) {
            return Str::toSnakeCase($header);
        }, array_shift($rows));
        foreach($rows as $row) {
            $data[] = array_combine($header, $row);
        }

        return $data;
    }
}
