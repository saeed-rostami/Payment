<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $products = Product::query()->paginate(10);
        return response()->json([
            $products
        ]);
    }



    /**
     * Show the specified resource.
     * @param Product $product
     * @return Renderable
     */
    public function show(Product $product)
    {
        return response()->json([
            $product
        ]);

    }

}
