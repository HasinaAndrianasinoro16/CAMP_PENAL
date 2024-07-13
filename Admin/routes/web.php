<?php

use App\Http\Controllers\ProfileController;
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

//GET METHODE
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified','admin'])->name('dashboard');

Route::get('/', [\App\Http\Controllers\UsersController::class,'Home'])->middleware(['auth', 'verified','admin'])->name('Home');

Route::get('/Utilisateur-page',[\App\Http\Controllers\UsersController::class,'Utilisateur'])->middleware(['auth', 'verified','admin'])->name('Utilisateur');

Route::get('/Ajout-Utilisateur-page',[\App\Http\Controllers\UsersController::class,'Addusers'])->middleware(['auth', 'verified','admin'])->name('AddUsers');

Route::get('/Delete-users/{id?}',[\App\Http\Controllers\UsersController::class,'DeleteUsers'])->middleware(['auth', 'verified','admin'])->name('DeleteUsers');

//POST METHODE
Route::post('/Ajout-utilisateur-form',[\App\Http\Controllers\UsersController::class,'FormAddUsers'])->middleware(['auth', 'verified','admin'])->name('FormAddUsers');


//AUTRE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
