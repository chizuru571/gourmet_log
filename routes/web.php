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
    Route::post('gourmet/create', 'add')->name('gourmet.create.back');
    //確認ページ
    Route::post('gourmet/confirm', 'confirm')->name('gourmet.confirm');
    //送信ページ
    Route::post('gourmet/send', 'send')->name('gourmet.send');
    //一覧ページ
    Route::get('gourmet', 'index')->name('gourmet.index');
    //編集ページ
    Route::get('gourmet/edit', 'edit')->name('gourmet.edit');
    Route::post('gourmet/edit', 'edit')->name('gourmet.edit.back');
    //確認ページ
    Route::post('gourmet/editconfirm', 'editconfirm')->name('gourmet.editconfirm');
    //更新ページ
    Route::post('gourmet/update', 'update')->name('gourmet.update');
    //削除
    Route::get('gourmet/delete', 'delete')->name('gourmet.delete');
    //詳細ページ
    Route::get('gourmet/detail', 'detail')->name('gourmet.detail');
    //カテゴリー一覧ページ
    Route::get('gourmet/category', 'category_add')->name('gourmet.category.add');
    Route::get('gourmet/category', 'category_index')->name('gourmet.category.index');
    Route::post('gourmet/category', 'category_create')->name('gourmet.category.create');
    //カテゴリー編集ページ
    Route::get('gourmet/category/edit', 'category_edit')->name('gourmet.category.edit');
    //カテゴリー更新ページ
    Route::post('gourmet/category/update', 'category_update')->name('gourmet.category.update');
    //カテゴリー削除ページ
    Route::get('gourmet/category/delete', 'category_delete')->name('gourmet.category.delete');
    //ダッシュボードページ
    Route::get('gourmet/dashboard', 'dashboard')->name('gourmet.dashboard');
    //トップページ
    Route::get('gourmet/top', 'top')->name('gourmet.top');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\TopController as PublicGourmetController;
Route::get('gourmet/top', [PublicGourmetController::class, 'top'])->name('gourmet.top');