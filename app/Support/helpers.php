<?php

declare(strict_types=1);

if (! function_exists('money_value_format')) {
    /**
     * @param  float|int|string  $value
     *
     * @return string
     */
    function money_value_format(float|int|string $value): string
    {
        $value = (float) $value;

        return number_format($value / 100, 2, '.', '');
    }
}
