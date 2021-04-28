<?php

declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Exception;

class MoneyFormatCast implements CastsAttributes
{
    /**
     * The name of the attribute from get we get the raw data.
     *
     * @var string
     */
    protected string $rawAttributeName;

    /**
     * Create a new cast instance.
     *
     * @param  string  $rawAttributeName
     *
     * @return void
     */
    public function __construct(string $rawAttributeName)
    {
        $this->rawAttributeName = $rawAttributeName;
    }

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     *
     * @return string|null
     */
    public function get($model, $key, $value, $attributes): ?string
    {
        $value = \data_get($attributes, [$this->rawAttributeName]);

        if ($value === null) {
            return null;
        }

        return \money_value_format($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     *
     * @return void
     *
     * @throws Exception
     */
    public function set($model, $key, $value, $attributes): void
    {
        throw new Exception("The property '{$key}' is readonly.");
    }
}
