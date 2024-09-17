<?php

declare(strict_types=1);

namespace Domain\DateTimezone\Service;

interface DateInfoServiceInterface
{
    /** @return array{'timezone': string, 'offset': int, 'february_days': int, 'month_name': string , 'month_days': int}  */
    public function processDateInfo(\DateTimeImmutable $date, \DateTimeZone $timezone): array;

}