<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\OpenApi(
 *  @OA\Info(
 *      title="DuckEat API",
 *      version="1.0.0",
 *      description="API documentation for DuckEat API",
 *      @OA\Contact(
 *          email="vincent.grande@outlook.fr"
 *      )
 *  ),
 *  @OA\PathItem(
 *      path="/DuckEat_Back/public/"
 *  )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
