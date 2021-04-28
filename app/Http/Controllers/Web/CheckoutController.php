<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Contracts\Services\BasketService;
use App\Contracts\Services\PaymentService;
use App\Models\Order;
use App\Events\CheckoutCompletedEvent;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Throwable;

class CheckoutController extends Controller
{
    /**
     * The BasketService instance.
     *
     * @var BasketService
     */
    protected BasketService $basketService;

    /**
     * Create a new controller instance.
     *
     * @param  BasketService  $basketService
     *
     * @return void
     */
    public function __construct(BasketService $basketService)
    {
        $this->basketService = $basketService;
    }

    /**
     * Display a page with a list of items in the cart.
     *
     * @return Response
     */
    public function index(): Response
    {
        $products = $this->basketService->getItems();

        return \response()->view('checkout.index', \compact('products'));
    }

    /**
     * Display the page with the checkout form.
     *
     * @return Response|RedirectResponse
     */
    public function purchase(): Response|RedirectResponse
    {
        $products = $this->basketService->getItems();

        if ($products === null) {
            return \redirect()->route('checkout.index');
        }

        return \response()->view('checkout.purchase', \compact('products'));
    }

    /**
     * Handle purchase confirmation.
     *
     * @param  CheckoutRequest  $request
     * @param  PaymentService  $paymentService
     *
     * @return Response
     */
    public function verifyPurchase(CheckoutRequest $request, PaymentService $paymentService): Response
    {
        $requestData = \collect($request->validationData());
        $shippingOption = $request->input('shipping_option', 'standard');
        $products = $this->basketService->getItems();

        $orderData = \array_merge($requestData->only(['client_name', 'client_address'])->all(), [
            'total_product_value' => $products->count(),
            'total_shipping_value' => $products->sum('price') + ($shippingOption === 'express' ? 1000 : 0),
        ]);

        $paymentData = \array_merge($requestData->only(['credit_card_number', 'credit_card_expiry', 'credit_card_cv'])->all(), [
            'amount' => $orderData['total_shipping_value'],
        ]);

        try {
            Order::resolveConnection()->transaction(function () use ($orderData, $paymentData, $products, $paymentService, $shippingOption) {
                $order = Order::create($orderData);
                $paymentService->process($paymentData);
                CheckoutCompletedEvent::dispatch($order, $products, $shippingOption);
                $this->basketService->clear();
            });
        } catch (Throwable $e) {
            if ($paymentService->isProcessed()) {
                $paymentService->rollback();
            }

            throw $e;
        }

        return \response()->view('checkout.completed', \compact('orderData', 'shippingOption', 'products'));
    }
}
