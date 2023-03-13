<?php

namespace App\Http\Controllers;

use App\Http\Resources\RestaurantResource;
use App\Http\Resources\TypeCollection;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TypeResource;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index():TypeCollection
    {
        return new TypeCollection(
            Type::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request):TypeResource
    {
        $type = Type::create(
            $request->all()
        );

        return new TypeResource(
            $type
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Type $type
     * @return TypeResource
     */
    public function show(Type $type): TypeResource
    {
        return new TypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Type $type
     * @return JsonResponse
     * @throws \Throwable
     */
    public function destroy(Request $request, Type $type)
    {
        //
    }
}
