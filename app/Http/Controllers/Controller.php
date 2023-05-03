<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Illuminae API Documentation",
 *      description="",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 * )
 * @OA\SecurityScheme(
 *    securityScheme="bearerAuth",
 *    in="header",
 *    name="bearerAuth",
 *    type="http",
 *    scheme="bearer",
 *    bearerFormat="JWT",
 *  ),
 *
 * @OA\Server(
 *      url="http://127.0.0.1:8000/",
 *      description="Local Api Server"
 * )
 * @OA\Server(
 *      url="http://server.test/",
 *      description="Laragon API Server"
 * )
*
* @OA\Tag(
*     name="Projects",
*     description="API Endpoints of Projects"
* )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


}
