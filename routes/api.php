<?php

use App\Http\Controllers\Api\TagsListController;
use App\Http\Controllers\Api\CommunityController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('tagslist', [TagsListController::class, 'tags'])->name('api.tags.whitelist');
Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
Route::get('/communities', [CommunityController::class, 'index'])->name('api.communities.index');
