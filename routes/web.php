<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Chargement de la page d'accueil
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'), 
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Si le membre est authentifié
Route::group(['auth:sanctum', 'verified'], function(){

    // Il peut accéder au listage des informations du HubSpot en utilisant le controller "HubspotController.php"
    Route::get('/dashboard', 'App\Http\Controllers\HubspotController@hubspot')->name('dashboard');
});

