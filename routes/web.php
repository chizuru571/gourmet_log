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
    //作成ページ
    Route::get('gourmet/create', 'add')->name('gourmet.add');
    //確認ページ
    Route::post('gourmet/confirm', 'confirm')->name('gourmet.confirm');
    //送信ページ
    Route::post('gourmet/send', 'send')->name('gourmet.send');
    //一覧ページ
    Route::get('gourmet', 'index')->name('gourmet.index');
    //編集ページ
    Route::get('gourmet/edit', 'edit')->name('gourmet.edit');
    //確認ページ
    Route::post('gourmet/edit_confirm', 'edit_confirm')->name('gourmet.edit_confirm');
    //更新ページ
    Route::post('gourmet/update', 'update')->name('gourmet.update');
    //削除
    Route::get('gourmet/delete', 'delete')->name('gourmet.delete');
    //詳細ページ
    Route::get('gourmet/detail', 'detail')->name('gourmet.detail');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
