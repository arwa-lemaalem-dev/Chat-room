<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HOMEController;

Route::get('chat',[ChatController::class,'chat']);
Route::post('sendMsg',[ChatController::class,'sendMsg']);
Route::get('pdfOffre/{id}',[ChatController::class,'pdf']);

Route::get('HOME',[ChatController::class,'listUser']);
Route::get('conversation',[ChatController::class,'GetConversation']);


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

