<?php

namespace Modules\Purchase\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Entities\Product;
use Modules\Purchase\Entities\Purchase;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
//
    }


    public function purchase(Product $product)
    {
        $user = Auth::user();
        $purchased = Purchase::query()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'paid' => 0
        ]);
        return $purchased;
    }


}
