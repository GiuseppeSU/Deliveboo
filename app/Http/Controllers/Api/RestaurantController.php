<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Product;

class RestaurantController extends Controller
{
    public function index(Request $request) {

        if($request->query('types')){
            $types = explode(',',$request->query('types'));
            $restaurants = Restaurant::with('types')
                            ->join('restaurant_type', 'id', '=', 'restaurant_type.restaurant_id')
                            ->whereIn('type_id',$types)
                            ->select('restaurants.*')
                            ->distinct()
                            ->get();
        }else{
            $restaurants = Restaurant::all();
        }

        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function show($id) {

        if($id) {

            $restaurant = Product::where('restaurant_id', '=', $id)
                        ->where('visibility','=', 1)
                        ->select('*')
                        ->get();

            return response()->json([
                'success' => true,
                'results' => $restaurant,
            ]);
        } else {

            abort(404);
        }

    
    }

}
