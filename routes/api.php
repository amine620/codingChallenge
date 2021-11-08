<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
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
 Route::get('categories',[CategoryController::class,'getCategories']);
Route::post('addNewCategory', [CategoryController::class, 'addNewCategory']);
Route::delete('deleteCategory/{category}', [CategoryController::class, 'deleteCategory']);

Route::get('products', [ProductController::class, 'getProducts']);
Route::post('addNewProduct', [ProductController::class, 'addNewProduct']);
Route::delete('deleteProduct/{category}', [ProductController::class, 'deleteProduct']);

