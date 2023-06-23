<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Restaurant;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

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
        $categories = [
            [
                'id' => 'primo piatto',
                'name' => 'primo piatto'
            ],
            [
                'id' => 'secondo piatto',
                'name' => 'secondo piatto'
            ],
            [
                'id' => 'antipasto',
                'name' => 'antipasto'
            ],
            [
                'id' => 'dolce',
                'name' => 'dolce'
            ],
            [
                'id' => 'pizza',
                'name' => 'pizza'
            ]
        ];
        return view('admin.products.create',compact('categories'));
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

        if ($request->hasFile('image')) {
            $path = Storage::put('image', $request->image);
            $validated_data['image'] = $path;
        }

        if ($request->has('visibility')) {

            $validated_data['visibility'] = 1;
        } else {

            $validated_data['visibility'] = 0;
        }

        $validated_data['restaurant_id'] = Auth::id();
        $newProduct = Product::create($validated_data);

        //$newProduct->products()->sync($request->validated_data);

        return to_route('admin.products.show', ['product' => $newProduct->slug])
            ->with('status', 'Success! Product created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if ($product->restaurant_id == Auth::id()) {
            return view('admin.products.show', compact('product'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if ($product->restaurant_id == Auth::id()) {
            $categories = [
                [
                    'id' => 'primo piatto',
                    'name' => 'primo piatto'
                ],
                [
                    'id' => 'secondo piatto',
                    'name' => 'secondo piatto'
                ],
                [
                    'id' => 'antipasto',
                    'name' => 'antipasto'
                ],
                [
                    'id' => 'dolce',
                    'name' => 'dolce'
                ],
                [
                    'id' => 'pizza',
                    'name' => 'pizza'
                ]
            ];
            return view('admin.products.edit', compact('product','categories'));
        } else {
            abort(404);
        }
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
        if ($product->restaurant_id == Auth::id()) {
            $validated_data = $request->validated();
            if ($request->hasFile('image')) {

                if ($product->image) {
                    Storage::delete($product->image);
                }

                $path = Storage::put('cover', $request->image);
                $validated_data['image'] = $path;
            }

            if ($request->has('visibility')) {

                $validated_data['visibility'] = 1;
            } else {

                $validated_data['visibility'] = 0;
                
            }

            //dd($validated_data);


            $product->update($validated_data);

            return to_route('admin.products.show', ['product' => $product->slug])
                ->with('status', 'Success! Product updated.');
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->restaurant_id == Auth::id()) {
            $product->delete();
            return redirect()->route('admin.products.index');
        } else {
            abort(404);
        }
    }

    public function deleteImg(Product $product)
    {
        if ($product->image){
            Storage::delete($product->image);
            $product->image = null;
            $product->save();
        }

        return to_route('admin.products.edit', $product->slug);
    }
}
