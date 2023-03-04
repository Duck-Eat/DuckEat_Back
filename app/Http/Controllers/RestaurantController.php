<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\EstDeType;

class RestaurantController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'image_Restaurant' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'nom_Restaurant' => 'required|string|max:255',
            'horaires_Restaurant' => 'required|string',
            'CP_Restaurant' => 'required|string|max:10',
            'adresse_Restaurant' => 'required|string|max:255',
            'ville_Restaurant' => 'required|string|max:255',
            'types_restaurant' => 'string'
        ]);
        $image_path = $request->file('image_Restaurant')->store('image', 'public');
        $restaurant = Restaurant::create([
            'nom_Restaurant' => $validatedData['nom_Restaurant'],
            'horaires_Restaurant' => $validatedData['horaires_Restaurant'],
            'CP_Restaurant' => $validatedData['CP_Restaurant'],
            'adresse_Restaurant' => $validatedData['adresse_Restaurant'],
            'ville_Restaurant' => $validatedData['ville_Restaurant'],
            'image_Restaurant' => "/storage/".$image_path,
        ]);
        $types = explode(",", $validatedData['types_restaurant']);
        foreach ($types as $id){
            EstDeType::create([
                'id_Restaurant' => $restaurant->id_Restaurant,
                'id_Types_Restaurant' => $id
            ]);
        }
        return response()->json([
            "message" => "Restaurant created."
        ], 201);
    }
    public function get(Request $request): JsonResponse{
        if($request['id']){
            $restaurants = Restaurant::where('id_Restaurant', $request['id'])->get();
        }else{
            $restaurants = Restaurant::all();
        }
        return response()->json([
            'restaurants' => $restaurants
        ],200);
    }
    public function update(Request $request): JsonResponse{

        return response()->json([
            'message' => 'update function not implemented'
        ],200);
    }
    public function delete(Request $request): JsonResponse{
        return response()->json([
            'message' => 'delete function not implemented'
        ],200);
    }
}
