<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\TypeCollection;
use App\Models\EstDeType;
use App\Models\Note;
use App\Models\Restaurant;
use App\Models\Type;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(): RestaurantCollection
    {
        $perPage = 10;
        return new RestaurantCollection(
            Restaurant::paginate($perPage)
            //Restaurant::all()
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

    public function uploadImage(Request $request,Restaurant $restaurant)
    {
        $image_path = $request->file('image')->store('image', 'public');
        $restaurant->update([
            'image' => $image_path
        ]);
        return new RestaurantResource($restaurant);
    }

    public function addNote(Request $request)
    {
        try
        {
            $note = Note::create(array_merge(
                $request->all(), ['user_id' => Auth::id() ?? 3]
            ));
            return new NoteResource(
                $note
            );
        }

        catch (Exception $e)
        {
            return response()->json([
                "message" => $e
            ],403);
        }


    }
    public function getNote(Request $request, Restaurant $restaurant)
    {
        return new NoteCollection(
            Note::where('restaurant_id',  $restaurant->id)->get()
        );
    }
}
