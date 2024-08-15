<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// We use this file for all API routes
// All routes added to api.php are automatically prefixed with /api/
// So if you have a route for /products you have to go to /api/products in the browser to see it

// Routes in this file are allowed to receive POST data

// Routing allows Laravel to take a request from a user and direct to the controller method responsible for that page
// Same idea as react router

// The routes/web.php file is intended to be used for routes/pages that display HTML
// There is also a routes/console.php file - this is for creating Laravel apps that work in the terminal
// We're not going be doing that


// This is the default route responsible for the Laravel homepage
// It does not use a controller class, instead it uses an anon function
Route::get('/', function () {
    return view('welcome');
});


// Cars
Route::get('/cars', [\App\Http\Controllers\CarController::class, 'getAllCars']);
Route::get('/cars/{id}', [\App\Http\Controllers\CarController::class, 'getSingleCar']);
Route::post('/cars', [\App\Http\Controllers\CarController::class, 'addCar']);
Route::delete('/cars/{id}', [\App\Http\Controllers\CarController::class, 'deleteCar']);
Route::put('/cars/{id}', [\App\Http\Controllers\CarController::class, 'updateCar']);


// Products
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'getAllProducts']);
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'getSingleProduct']);
Route::post('/products', [\App\Http\Controllers\ProductController::class, 'addProduct']);
Route::delete('/products/{id}', [\App\Http\Controllers\ProductController::class, 'deleteProduct']);
Route::put('/products/{id}', [\App\Http\Controllers\ProductController::class, 'updateProduct']);


// Fungi

// All Fungi
Route::get('/fungi', [\App\Http\Controllers\FungusController::class, 'getAllFungi']);
Route::get('/fungi/{id}', [\App\Http\Controllers\FungusController::class, 'getSingleFungi']);
Route::post('/fungi', [\App\Http\Controllers\FungusController::class, 'addFungus']);
Route::delete('/fungi/{id}', [\App\Http\Controllers\FungusController::class, 'deleteFungus']);
Route::put('/fungi/{id}', [\App\Http\Controllers\FungusController::class, 'updateFungus']);

// Categories

// All Categories
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'getAllCategories']);

// Single Category
Route::get('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'getSingleCategory']);


// Clients

// All Clients
Route::get('/clients', [\App\Http\Controllers\ClientController::class, 'getAllClients']);

// Single Client
Route::get('/clients/{id}', [\App\Http\Controllers\ClientController::class, 'getSingleClient']);
