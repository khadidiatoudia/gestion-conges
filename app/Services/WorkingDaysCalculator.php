<?php

namespace App\Services;

use App\Models\JourFerie;
use Carbon\Carbon;

class WorkingDaysCalculator
{
    public static function isHoliday(Carbon $date): bool
    {
        return JourFerie::whereDate('date', $date->toDateString())->exists();
    }

    public static function isWorkingDay(Carbon $date): bool
    {
        if ($date->isSunday()) {
            return false;
        }

        return !static::isHoliday($date);
    }

    public static function nextWorkingDay(Carbon $date): Carbon
    {
        $current = $date->copy()->addDay();

        while (!static::isWorkingDay($current)) {
            $current->addDay();
        }

        return $current;
    }

    public static function addWorkingDays(Carbon $start, int $days): Carbon
    {
        $current = $start->copy();

        if (!static::isWorkingDay($current)) {
            $current = static::nextWorkingDay($current->subDay());
        }

        $remaining = max(0, $days - 1);

        while ($remaining > 0) {
            $current->addDay();

            if (static::isWorkingDay($current)) {
                $remaining--;
            }
        }

        return $current;
    }
}
