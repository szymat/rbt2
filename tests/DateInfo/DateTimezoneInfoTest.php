<?php

namespace App\Tests\DateInfo;

use Domain\DateTimezone\Model\DateTimezoneInfo;
use PHPUnit\Framework\TestCase;

class DateTimezoneInfoTest extends TestCase
{
    public static function provideTestCases() : \Generator
    {
        yield [
            'date' => '2019-07-10',
            'timezone' => 'Europe/London',
            'expected' => [
                'timezone' => 'Europe/London',
                'offset' => 60,
                'february_days' => 28,
                'month_name' => 'July',
                'month_days' => 31,
            ],
        ];

        yield [
            'date' => '2016-11-28',
            'timezone' => 'Asia/Tokyo',
            'expected' => [
                'timezone' => 'Asia/Tokyo',
                'offset' => 540,
                'february_days' => 29,
                'month_name' => 'November',
                'month_days' => 30,
            ],
        ];

        yield [
            'date' => '1853-01-30',
            'timezone' => 'America/Lower_Princes',
            'expected' => [
                'timezone' => 'America/Lower_Princes',
                'offset' => -240,
                'february_days' => 28,
                'month_name' => 'January',
                'month_days' => 31,
            ],
        ];
    }

    /**
     * @dataProvider provideTestCases
     */
    public function testDateTimezoneInfo(string $date, string $timezone, array $expected): void
    {
        $dateTimezoneInfo = new DateTimezoneInfo(new \DateTimeImmutable($date), new \DateTimeZone($timezone));
        $result = $dateTimezoneInfo->jsonSerialize();
        $this->assertEquals($expected, $result);
    }
}