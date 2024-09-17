<?php

declare(strict_types=1);

namespace Application\DTO;

class DateInfoDTO
{
    private ?string $date = null;
    private ?string $timezone = null;

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function getDateTime(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d', $this->date);
    }

    public function getDateTimezone(): \DateTimeZone
    {
        return new \DateTimeZone($this->timezone);
    }
}
