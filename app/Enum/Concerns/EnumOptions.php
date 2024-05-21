<?php

namespace App\Enum\Concerns;

trait EnumOptions
{
    public static function options(): array
    {
        $options = array();

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->name;
        }

        return $options;
    }
}
