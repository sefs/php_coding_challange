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

    public function testSameString()
    {
        self::assertTrue(Str::same('test', 'Test'));
        self::assertTrue(Str::same('Test', 'test'));
        self::assertTrue(Str::same('TeSt', 'tEsT'));

        self::assertFalse(Str::same('foo', 'bar'));
        self::assertFalse(Str::same('bar', 'baz'));
    }
}
