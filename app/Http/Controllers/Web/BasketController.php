<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Contracts\Services\BasketService;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class BasketController extends Controller
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
     * Handle the request to add an item to the basket.
     *
     * @return Response|RedirectResponse
     */
    public function add(): Response|RedirectResponse
    {
        if (! $this->basketService->add(\request()->input('id'))) {
            return \response()->view('basket.notfound')->setStatusCode(404);
        }

        return \redirect()->route('checkout.index');
    }

    /**
     * Handle the request to remove an item from the basket.
     *
     * @return RedirectResponse
     */
    public function remove(): Response
    {
        $this->basketService->remove(\request()->route('id'));

        return \redirect()->route('checkout.index');
    }
}
