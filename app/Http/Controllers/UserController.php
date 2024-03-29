<?php

namespace App\Http\Controllers;

use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function randomRestaurant(Request $request) : RestaurantCollection
    {
        $types = Auth::user()->types->pluck('id');

        if(!$types->containsOneItem() || $types[0] == "1"){
            $restaurant = Restaurant::join(
                'restaurants_types',
                'restaurants_types.restaurant_id',
                '=',
                'restaurants.id')
                ->get();
        }else{
            $restaurant = Restaurant::join(
                'restaurants_types',
                'restaurants_types.restaurant_id',
                '=',
                'restaurants.id')
                ->whereIn('restaurants_types.type_id', $types)
                ->get();
        }
        return new RestaurantCollection($restaurant->random(10));
    }

    public function userRestaurant(Request $request) : RestaurantCollection
    {
        $restaurants = Restaurant::where('user_id', Auth::user()->id)->get();
        return new RestaurantCollection($restaurants);
    }
}
