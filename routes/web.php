<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('article/{n}', [ArticleController::class, 'show'])->where('n', '[0-9]+');


Route::get('facture/{n}', function($n) {
    return view('facture')->withNumero($n);
})->where('n', '[0-9]+');

// Route::get('/', function() {
//     return 'Je suis la page d\'accueil !';
//   })->name('home');

Route::get('{i?}', function($i=0) { return 'Je suis la page ' . $i . '!'; })->where('i', '[1-3]');

Route::get('contact', function() {
    return "Moi c'est le contact.";
});

Route::get('test', function () {
    return response('un test', 206)->header('Content-Type', 'text/plain');
});