<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Product;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {

        if ($request->query('types')) {
            $types = explode(',', $request->query('types'));
            $restaurants = Restaurant::with('types')
                ->join('restaurant_type', 'id', '=', 'restaurant_type.restaurant_id')->join('types', 'type_id', 'types.id')
                ->whereIn('types.slug', $types)
                ->select('restaurants.*')
                ->distinct()
                ->get();

            $filteredRestaurants = [];
            foreach ($restaurants as $restaurant) {
                //salvo i tipi di cucina del ristorante ciclato in un array
                $restaurantTypes = [];
                foreach($restaurant->types as $type){
                    $restaurantTypes[] = $type->slug;
                }
                $matchingTypes = true;
                foreach ($types as $type){
                    if(!in_array($type,$restaurantTypes)){
                        $matchingTypes = false;
                    }
                }
                if($matchingTypes){
                    $filteredRestaurants[] = $restaurant;
                }
            }
            $restaurants = $filteredRestaurants;
        } else {
            $restaurants = Restaurant::all();
        }

        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function show($slug)
    {
        $restaurant = Restaurant::where('restaurants.slug', $slug)
            ->with('products')
            ->join('products','restaurants.id','restaurant_id')
            ->where('products.visibility', 1)
            ->select('restaurants.*')
            ->distinct()
            ->get();

        return response()->json([
            'success' => true,
            'results' => $restaurant,
        ]);
    }
}
