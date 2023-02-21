<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Returns test string
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *   path="/api/test",
     *   tags={"TestController"},
     *   @OA\Response(
     *     response="200",
     *     description="Returns test string",
     *     content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="errcode",
     *                         type="integer",
     *                         description="The response code"
     *                     ),
     *                     @OA\Property(
     *                         property="errmsg",
     *                         type="string",
     *                         description="The response message"
     *                     ),
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         description="The response data",
     *                         @OA\Items
     *                     ),
     *                     example={
     *                         "errcode": 1,
     *                         "errmsg": "ok",
     *                         "data": {}
     *                     }
     *                 )
     *             )
     *         }
     *   )
     * )
     */
    public function test(): \Illuminate\Http\JsonResponse{

        return response()->json([
            'message' => "It Works !"
        ],200);
    }

}
