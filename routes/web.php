<?php

use App\Http\Controllers\EnterController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SeasonsController;
use App\Mail\MailNewSeries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

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
Route::get('/', [SeriesController::class, 'index'])
    ->name('list_series');
Route::get('/create', [SeriesController::class, 'create'])
    ->name('create_series')
    ->middleware('authenticator');
Route::post('/create', [SeriesController::class, 'store'])
    ->middleware('authenticator');
Route::delete('/{id}', [SeriesController::class, 'destroy'])
    ->middleware('authenticator');
Route::get('/{seriesId}/seasons', [SeasonsController::class, 'index']);
Route::post('/{seriesId}/editName', [SeriesController::class, 'editName'])
    ->middleware('authenticator');
Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index']);
Route::post('/seasons/{season}/episodes/watch', [EpisodesController::class, 'watch'])
    ->middleware('authenticator');
Route::get('/enter', [EnterController::class, 'index']);
Route::post('/enter', [EnterController::class, 'enter']);
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/out', function () {
    Auth::logout();
    return redirect('/enter');
});

Route::get('/visualize-mail', function () {
    return new MailNewSeries(
        'Big Bang Theory',
        1,
        1
    );
});

Route::get('/send-mail', function () {
    return new MailNewSeries(
        'Big Bang Theory',
        1,
        1
    );
});
