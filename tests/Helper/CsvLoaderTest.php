<?php

namespace Tests\App\Helper;

use App\Helper\CsvLoader;
use PHPUnit\Framework\TestCase;

class CsvLoaderTest extends TestCase
{
    public function testLoadToAssocArray(): void
    {
        $file = '/www/vacancies.csv';
        $data = CsvLoader::loadToAssocArray($file);

        self::assertNotEmpty($data);
        self::assertCount(27, $data);
    }

    public function testLoadWillReturnEmptyArrayForNonExisitingFile()
    {
        $file = './missing.csv';

        self::assertEmpty(CsvLoader::loadToAssocArray($file));
    }


}
