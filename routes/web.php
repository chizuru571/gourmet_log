<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\GourmetController;
Route::controller(GourmetController::class)->middleware('auth')->group(function() {
    Route::get('gourmet/create', 'add')->name('gourmet.add');
    Route::post('gourmet/create', 'create')->name('gourmet.create');
    Route::get('gourmet', 'index')->name('gourmet.index');
    Route::get('gourmet/edit', 'edit')->name('gourmet.edit');
    Route::post('gourmet/edit', 'update')->name('gourmet.update');
    Route::get('gourmet/delete', 'delete')->name('gourmet.delete');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
