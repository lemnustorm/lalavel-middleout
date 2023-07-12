<?php


use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$res404 = fn() => response()->json(['message' => 'Not found'], 404);

Route::get('/articles', [ArticleController::class, 'index']);
Route::post('/articles', [ArticleController::class, 'create']);
Route::patch('/articles/{article}', [ArticleController::class, 'update'])->missing($res404);
Route::delete('/articles/{article}', [ArticleController::class, 'unPublishOrDelete'])->missing($res404);
