<?php

namespace App\Http\Controllers;

use App\Models\TypesRestaurant;
use Illuminate\Http\Request;

class TypeRestaurantController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse{
        $validatedData = $request->validate( [
            'type' => 'required|string|max:255',
        ]);

        $typeRestaurant = TypesRestaurant::create([
            'type_Types_restaurant' => $validatedData['type']
        ]);

        return response()->json([
            'message'=> 'Type restaurant created'
        ], 201);
    }
}
