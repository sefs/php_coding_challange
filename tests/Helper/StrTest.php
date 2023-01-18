<?php

namespace Tests\App\Helper;

use App\Helper\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testStrToSnakeCase($expected, $input): void
    {
        self::assertSame($expected, Str::toSnakeCase($input));
    }

    public function provideData(): array
    {
        return [
            [
                'id',
                'ID',
            ],
            [
                'required_skills',
                'Required skills',
            ],
            [
                'string_to_snake_case',
                'String To Snake Case',
            ],
        ];
    }


}
