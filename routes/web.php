<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FilmController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//* ----------------------------- *//

// Route::get('/', [WelcomeController::class, 'index'])->name('index');

Route::get('article/{n}', [ArticleController::class, 'show'])->where('n', '[0-9]+');

Route::get('users', [UsersController::class, 'create']);
Route::post('users', [UsersController::class, 'store']);

Route::get('contact', [ContactController::class, 'create']);
Route::post('contact', [ContactController::class, 'store']);

Route::get('/test-contact', function () {
    return new App\Mail\Contact([
      'nom' => 'Sam',
      'email' => 'SamLePianiste@example.com',
      'message' => 'Je suis Sam le pianiste !'
      ]);
});

Route::get('photo', [PhotoController::class, 'create']);
Route::post('photo', [PhotoController::class, 'store']);

Route::get('contacts', [ContactsController::class, 'create'])->name('contact.create');
Route::post('contacts', [ContactsController::class, 'store'])->name('contact.store');

Route::resource('films', FilmController::class)->middleware('guest');

Route::controller(FilmController::class)->group(function () {
    Route::delete('films/force/{id}', 'forceDestroy')->name('films.force.destroy');
    Route::put('films/restore/{id}', 'restore')->name('films.restore');
    Route::get('category/{slug}/films', 'index')->name('films.category');
    Route::get('actor/{slug}/films', 'index')->name('films.actor');
});

Route::get('facture/{n}', function($n) {
    return view('facture')->withNumero($n);
})->where('n', '[0-9]+');

// Route::get('/', function() {
//     return 'Je suis la page d\'accueil !';
//   })->name('home');

Route::get('{i?}', function($i=0) { return 'Je suis la page ' . $i . '!'; })->where('i', '[1-3]');

// Route::get('contact', function() {
//     return "Moi c'est le contact.";
// });

Route::get('test', function () {
    return response('un test', 206)->header('Content-Type', 'text/plain');
});