<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function(){
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/cari', [HomeController::class, 'cari']);

Route::get('/detailevent/{id}', [HomeController::class, 'show']);
Route::post('/detailevent/beli', [HomeController::class, 'beli']);

Route::get('/profile', [ProfileController::class, 'index']);

Route::get('/tiket/{id}', [HomeController::class, 'lihattiket']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
