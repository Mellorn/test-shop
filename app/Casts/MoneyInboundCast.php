<?php

declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use Exception;

class MoneyInboundCast implements CastsInboundAttributes
{
    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  float|int|string  $value
     * @param  array  $attributes
     *
     * @return int
     *
     * @throws Exception
     */
    public function set($model, $key, $value, $attributes): int
    {
        if (! \is_numeric($value)) {
            throw new Exception("The '{$key}' property can only be assigned a numeric value.");
        }

        $value = (float) $value;

        if ($value <= 0) {
            throw new Exception("The value of the property '{$key}' must be a positive number.");
        }

        return (int) \round($value * 100);
    }
}
