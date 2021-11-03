<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\AdminProductRequest;

class AdminProductController extends Controller
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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(AdminProductRequest $request)
    {
        $product = Product::query()->create([
           'name' => $request->name,
           'price' => $request->price,
           'code' => $request->code,
        ]);
        return response()->json([
            'message' => 'با موفقیت محصول ایجاد شد'
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Product $product)
    {
        return response()->json([
            $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param AdminProductRequest $request
     * @param Product $product
     * @return Renderable
     */
    public function update(AdminProductRequest $request, Product $product)
    {
         $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'code' => $request->code,
        ]);
        return response()->json([
            'message' => 'با موفقیت محصول ویرایش شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'با موفقیت محصول حذف شد'
        ]);
    }
}
