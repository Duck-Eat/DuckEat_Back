<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeCollection;
use App\Models\Preference;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TypeCollection
     */
    public function index() : TypeCollection
    {
        return new TypeCollection(auth()->user()->types()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $preference): TypeCollection
    {
        $preference->updateOrFail($request->all());

        if (isset($request->types) && !empty($request->types)) {
            $types = explode(',', $request->types);
            $preference->types()->sync(Type::findMany($types));
        }
        $preference->refresh();
        return new TypeCollection($preference->types()->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
