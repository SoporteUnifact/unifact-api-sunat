<?php

declare(strict_types=1);

namespace App\Services\FacturacionElectronica\Core\Models;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use App\Services\FacturacionElectronica\Core\Models\TimeZonePe;

trait TimezonePeTrait
{
    protected function getDateWithTimezone(DateTimeInterface $date): DateTimeInterface
    {
        $timezone = new DateTimeZone(TimeZonePe::DEFAULT);
        if ($date instanceof DateTime) {
            $date = clone $date;
            return $date->setTimezone($timezone);
        }

        return $date->setTimezone($timezone);
    }
}
