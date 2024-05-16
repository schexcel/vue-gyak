<?php

use App\Http\Controllers\DrinkResourceController;
use App\Http\Controllers\FlavorResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::apiResource('flavors', FlavorResourceController::class)
    ->only(['index'])
    ->missing(function (Request $request) {
        return Response::json([
            'data' => null,
            'success' => false,
            'message' => "Flavor not exists!"
        ], 404);
    });

Route::apiResource('drinks', DrinkResourceController::class)
    ->only(['index', 'show', 'store'])
    ->missing(function (Request $request) {
        return Response::json([
            'data' => null,
            'success' => false,
            'message' => "Drink not exists!"
        ], 404);
    });
