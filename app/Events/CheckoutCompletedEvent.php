<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;

class CheckoutCompletedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * The Order instance.
     *
     * @var Order
     */
    public Order $order;

    /**
     * A collection of products included in the order.
     *
     * @var Collection
     */
    public Collection $products;

    /**
     * The shipping option that was selected at checkout.
     *
     * @var string
     */
    public string $shippingOption;

    /**
     * Create a new event instance.
     *
     * @param  Order  $order
     * @param  Collection  $products
     * @param  string  $shippingOption
     *
     * @return void
     */
    public function __construct(Order $order, Collection $products, string $shippingOption)
    {
        $this->order = $order;
        $this->products = $products;
        $this->shippingOption = $shippingOption;
    }
}
