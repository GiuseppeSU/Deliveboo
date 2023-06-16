<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Restaurant;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Trova il ristorante corrente
        //$products = Product::all();
        //$products = Product::where('restaurant_id', 1)->get();
        $products = Product::where('restaurant_id', Auth::id())->get();
        // Ottieni solo i piatti relativi al ristorante corrente
        // $products = $restaurant->products;

        // Restituisci i piatti alla vista
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validated_data = $request->validated();

        // if($request->hasFile('image')) {
        //     $path = Storage::put('image', $request->image);
        //     $validated_data['image'] = $path;
        // }

        $validated_data['restaurant_id'] = Auth::id();
        $newProduct = Product::create($validated_data);

        return to_route('admin.products.show', ['product' => $newProduct->id])
        ->with('status', 'Success! Project created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated_data = $request->validated();

        // if ($request->hasFile('image')) {

        //     if ($product->cover_image) {
        //         Storage::delete($product->cover_image);
        //     }

        //     $path = Storage::put('cover', $request->cover_image);
        //     $validated_data['cover_image'] = $path;

        // }


        $product->update($validated_data);

        return to_route('admin.products.show', ['product' => $product->id])
        ->with('status', 'Success! Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
