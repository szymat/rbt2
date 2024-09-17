<?php

declare(strict_types=1);

namespace Domain\DateTimezone\Model;

class DateTimezoneInfo implements \JsonSerializable
{
    private \DateTimeImmutable $date;
    private \DateTimeZone $timezone;

    public function __construct(\DateTimeImmutable $date, \DateTimeZone $timezone)
    {
        $this->date = $date;
        $this->timezone = $timezone;
        $this->date->setTimezone($this->timezone);
    }

    public function getTimezoneOffset(): float
    {
        $transitions = $this->timezone->getTransitions($this->date->getTimestamp(), $this->date->getTimestamp());

        if (!empty($transitions)) {
            return (int) (round($transitions[0]['offset'] / 3600) * 60);
        }

        return (int) round($this->timezone->getOffset($this->date) / 60);
    }

    public function getFebruaryDays(): int
    {
        return (int) $this->date->format('L') === 1 ? 29 : 28;
    }

    public function getMonthName(): string
    {
        return $this->date->format('F');
    }

    public function getMonthDays(): int
    {
        return (int) $this->date->format('t');
    }

    public function jsonSerialize() : array
    {
        return [
            'timezone' => $this->timezone->getName(),
            'offset' => $this->getTimezoneOffset(),
            'february_days' => $this->getFebruaryDays(),
            'month_name' => $this->getMonthName(),
            'month_days' => $this->getMonthDays(),
        ];
    }
}