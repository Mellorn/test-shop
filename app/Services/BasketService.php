<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\BasketService as ServiceContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

final class BasketService implements ServiceContract
{
    /**
     * @var string
     */
    protected const STORAGE_KEY = 'basket';

    /**
     * Get the current number of items in the basket.
     *
     * @return int
     */
    public function count(): int
    {
        $items = $this->getItemsIds();

        return \count($items);
    }

    /**
     * Get IDs of products added to basket.
     *
     * @return array
     */
    public function getItemsIds(): array
    {
        return \session()->get(static::STORAGE_KEY) ?? [];
    }

    /**
     * Add item to basket.
     *
     * @param  mixed  $id
     *
     * @return bool
     */
    public function add(mixed $id): bool
    {
        if (! $this->productExists($id)) {
            return false;
        }

        $items = \array_unique([
            ...$this->getItemsIds(),
            (int) $id,
        ]);
        \session()->put(static::STORAGE_KEY, \array_values($items));

        return true;
    }

    /**
     * Check if the product exists.
     *
     * @param  mixed  $id
     *
     * @return bool
     */
    protected function productExists(mixed $id): bool
    {
        $id = \filter_var($id, \FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        return $id !== false && Product::whereKey($id)->exists();
    }

    /**
     * Remove item from basket.
     *
     * @param  mixed  $id
     *
     * @return void
     */
    public function remove(mixed $id): void
    {
        $items = $this->getItemsIds();
        $index = \array_search($id, $items);

        if ($index !== false) {
            unset($items[$index]);
            \session()->put(static::STORAGE_KEY, \array_values($items));
        }
    }

    /**
     * Clear basket.
     *
     * @return void
     */
    public function clear(): void
    {
        \session()->remove(static::STORAGE_KEY);
    }

    /**
     * Get a collection of items in basket.
     *
     * @return Collection|null
     */
    public function getItems(): ?Collection
    {
        $items = $this->getItemsIds();

        if (\count($items) === 0) {
            return null;
        }

        $items = Product::with('brand')->findMany($items);

        return $items->isNotEmpty() ? $items : null;
    }
}
