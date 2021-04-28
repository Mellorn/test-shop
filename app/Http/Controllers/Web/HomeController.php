<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Contracts\Services\BasketService;
use App\Models\Product;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return Response
     */
    public function __invoke(BasketService $basketService): Response
    {
        $products = Product::with('brand')
            ->orderBy('id')
            ->paginate();
        $basketItemsCount = $basketService->count();

        return \response()->view('home.index', \compact('products', 'basketItemsCount'));
    }
}
