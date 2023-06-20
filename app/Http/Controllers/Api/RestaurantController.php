<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request) {

        if($request->query('types')){
            $types = explode(',',$request->query('types'));
            $restaurants = Restaurant::with('types')->join('restaurant_type', 'id', '=', 'restaurant_type.restaurant_id')->whereIn('type_id',$types)->get();
        }else{
            $restaurants = Restaurant::all();
        }

        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

}
