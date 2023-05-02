<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavorisCollection;
use App\Http\Resources\FavorisResource;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Favoris;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavorisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): FavorisCollection
    {
        $perPage = 10;
        return new FavorisCollection(
            Favoris::where('user_id',Auth::id())->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): FavorisResource
    {
        $favoris = Favoris::create(array_merge(
            $request->all(), ['user_id' => Auth::id() ?? 3]
        ));

        return new FavorisResource(
            $favoris
        );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param Favoris $favoris
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(Request $request, Favoris $favori): JsonResponse
    {
        if($favori->user_id == Auth::id()){
            return response()->json([
                'result' => $favori->deleteOrFail()
            ]);
        }
        return response()->json([
            'result' => false
        ]);
    }
}
