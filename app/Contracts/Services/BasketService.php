<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

interface BasketService
{
    /**
     * Get the current number of items in the basket.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Add item to basket.
     *
     * @param  mixed  $id
     *
     * @return bool
     */
    public function add(mixed $id): bool;

    /**
     * Remove item from basket.
     *
     * @param  mixed  $id
     *
     * @return void
     */
    public function remove(mixed $id): void;

    /**
     * Clear basket.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Get a collection of items in basket.
     *
     * @return Collection|null
     */
    public function getItems(): ?Collection;
}
