<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// login
Route::post('login', [AuthController::class, 'login']);

// chat
Route::post('send/chat/{receiverId}', [ChatController::class, 'sendChat'])->middleware(['auth:api']);
Route::get('message', [ChatController::class, 'getMessage'])->middleware(['auth:api']);
Route::post('replay/chat/{receiverId}', [ChatController::class, 'replyChat'])->middleware(['auth:api']);
Route::get('message/detail/{sender_id}', [ChatController::class, 'getMeesageDetail'])->middleware(['auth:api']);
Route::get('message/last/{sender_id}', [ChatController::class, 'getLastMessage'])->middleware(['auth:api']);
Route::get('count/{sender_id}', [ChatController::class, 'countMessage'])->middleware(['auth:api']);
