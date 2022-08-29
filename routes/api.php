<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Books\BooksController;
use App\Http\Controllers\Equipments\EquipmentsController;
use App\Http\Controllers\RentalLogController;

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

// User Public Routes
Route::controller(UsersController::class)->group(function () {
    Route::get('users', 'listUsers');
    Route::get('users/{id}', 'getUser');
    Route::post('users', 'create');
    Route::put('users/{id}', 'update');
    Route::delete('users/{id}', 'destroy');
});

// Book Public Routes
Route::controller(BooksController::class)->group(function () {
    Route::get('books', 'listBooks');
    Route::get('books/{id}', 'getBook');
    Route::post('books', 'create');
    Route::put('books/{id}', 'update');
    Route::delete('books/{id}', 'destroy');
});

// Equipment Public Routes
Route::controller(EquipmentsController::class)->group(function () {
    Route::get('equipments', 'listEquipments');
    Route::get('equipments/{id}', 'getEquipment');
    Route::post('equipments', 'create');
    Route::put('equipments/{id}', 'update');
    Route::delete('equipments/{id}', 'destroy');
});

// Statistic Log Public Route
Route::get('rented_activities_stats', [RentalLogController::class, 'stats']);
