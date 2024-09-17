<?php

declare(strict_types=1);

namespace Domain\DateTimezone\Service;

use Domain\DateTimezone\Model\DateTimezoneInfo;

class DateInfoService implements DateInfoServiceInterface
{
    /** @inheritDoc */
    public function processDateInfo(\DateTimeImmutable $date, \DateTimeZone $timezone): array
    {
        return (new DateTimezoneInfo($date, $timezone))->jsonSerialize();
    }
}