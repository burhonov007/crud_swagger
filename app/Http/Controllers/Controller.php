<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

    /**
    *@OA\Info(
    *      version="1.0.0",
    *      title="CRUD API",
    *      description=" Demonstration of the created API",
    *)
    * @OA\Tag(
    *     name="Users",
    *     description="Users",
    * )
    * @OA\Tag(
    *     name="Posts",
    *     description="Posts",
    * )
    * @OA\Server(
    *    description = "CRUD API SERVER",
    *    url = "http://127.0.0.1:8000/api",
    *)
    * @OA\SecurityScheme(
    *   type="apiKey",
    *   in="header",
    *   name="bearer",
    *   securityScheme="token",
    *)
    */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
