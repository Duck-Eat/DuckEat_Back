<?php

namespace App\Http\Controllers;

use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\EstDeType;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(): RestaurantCollection
    {
        return new RestaurantCollection(
            Restaurant::paginate()
        );
    }

    public function store(Request $request): RestaurantResource
    {
        $restaurant = Restaurant::create(array_merge(
            $request->all(), ['user_id' => Auth::id() ?? 3]
        ));

        return new RestaurantResource(
            $restaurant
        );
    }

    public function show(Request $request, Restaurant $restaurant): RestaurantResource
    {
        return new RestaurantResource($restaurant);
    }

    public function update(Request $request, Restaurant $restaurant): RestaurantResource
    {
        $restaurant->updateOrFail($request->all());

        if (isset($request->types) && !empty($request->types)) {
            $types = explode(',', $request->types);
            $restaurant->types()->sync(Type::findMany($types));
        }

        return new RestaurantResource($restaurant->refresh());
    }

    public function destroy(Request $request, Restaurant $restaurant): JsonResponse
    {
        return response()->json([
            'result' => $restaurant->deleteOrFail()
        ]);
    }
}
