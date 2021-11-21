<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\UserJoined;
use App\Events\GiftSent;
use App\Events\TeamsFetched;
use App\Http\Resources\UserGfitResource;
use App\Http\Resources\UserResource;
use App\Models\UserGift;
use App\Mallcoo;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });