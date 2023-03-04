<?php

namespace App\Http\Controllers;

use App\Models\TypesRestaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeRestaurantController extends Controller
{
    public function store(Request $request): JsonResponse{
        $validatedData = $request->validate( [
            'type' => 'required|string|max:255',
        ]);
        $typeRestaurant = TypesRestaurant::create([
            'type_Types_restaurant' => $validatedData['type']
        ]);
        return response()->json([
            'type' => $typeRestaurant,
            'message'=> 'Type restaurant created'
        ], 201);
    }
    public function update(Request $request): JsonResponse{
        $validatedData = $request->validate([
            'id' => 'required|int',
            'type' => 'required|string|max:255',
        ]);
        TypesRestaurant::where('id_Types_restaurant', $validatedData['id'])
            ->update([
                'type_Types_restaurant' => $validatedData['type']
            ]);
        return response()->json([
            'message' => 'Type successfully updated'
        ],200);
    }
    public function get(Request $request): JsonResponse{
        if($request['id']){
            $types = TypesRestaurant::where('id_Types_restaurant', $request['id'])->get();
        }else{
            $types = TypesRestaurant::all();
        }
        return response()->json([
            'types' => $types
        ],200);
    }
    public function delete(Request $request): JsonResponse{
        $validatedData = $request->validate([
            'id' => 'required|int',
        ]);
        TypesRestaurant::where('id_Types_restaurant', $validatedData['id'])->delete();
        return response()->json([
            'message' => 'Type successfully deleted'
        ],200);
    }
}
