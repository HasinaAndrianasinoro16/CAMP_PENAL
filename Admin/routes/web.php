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

Route::get('/Camp-penal-page',[\App\Http\Controllers\CampController::class,'Camp'])->middleware(['auth', 'verified','admin'])->name('Camp');

Route::get('/Camp-penal-Carte',[\App\Http\Controllers\CampController::class,'Carte'])->middleware(['auth', 'verified','admin'])->name('Carte');

Route::get('/Delete-camp-penal/{id?}',[\App\Http\Controllers\CampController::class,'DeleteCamp'])->middleware(['auth', 'verified','admin'])->name('DeleteCamp');

Route::get('/Update-users-page/{id?}',[\App\Http\Controllers\UsersController::class,'UpdateUsers'])->middleware(['auth', 'verified','admin'])->name('UpdateUsers');

Route::get('/Update-Map-page/{id?}',[\App\Http\Controllers\CampController::class,'UpdateCamp'])->middleware(['auth', 'verified','admin'])->name('UpdateCamp');

Route::get('/Map-detail/{id?}',[\App\Http\Controllers\CampController::class,'DetailCamp'])->middleware(['auth', 'verified','admin'])->name('DetailCamp');

Route::get('/Ajout-culture-page/{id?}',[\App\Http\Controllers\CampController::class,'AddCulture'])->middleware(['auth', 'verified','admin'])->name('AddCulture');

Route::get('/Ajout-info-camp-supplementaire/{id?}',[\App\Http\Controllers\CampController::class,'AddInfo'])->middleware(['auth', 'verified','admin'])->name('AddInfo');

Route::get('/Formulaire-Ajout-SituationJudiciaire',[\App\Http\Controllers\CampController::class,'Situation'])->middleware(['auth', 'verified','admin'])->name('Situation');

Route::get('/Recensement/{id?}',[\App\Http\Controllers\CampController::class,'Recensement'])->middleware(['auth', 'verified','admin'])->name('Recensement');

Route::get('/Culture-liste',[\App\Http\Controllers\CultureController::class,'Culture'])->middleware(['auth', 'verified','admin'])->name('Culture');

Route::get('/Formluaire-Culture',[\App\Http\Controllers\CultureController::class,'NewCulture'])->middleware(['auth', 'verified','admin'])->name('NewCulture');

Route::get('/Update-culture/{id?}',[\App\Http\Controllers\CultureController::class,'updateCulture'])->middleware(['auth', 'verified','admin'])->name('UpdateCulture');

Route::get('/Message',[\App\Http\Controllers\MessageController::class,'Message'])->middleware(['auth', 'verified','admin'])->name('message');

Route::get('/conversion/{id?}',[\App\Http\Controllers\MessageController::class,'Conversation'])->middleware(['auth', 'verified','admin'])->name('Conversation');

Route::get('/Erreur',function (){
    return view('Error');
});

//POST METHODE
Route::post('/Ajout-utilisateur-form',[\App\Http\Controllers\UsersController::class,'FormAddUsers'])->middleware(['auth', 'verified','admin'])->name('FormAddUsers');

Route::post('/Ajout-camp-penal',[\App\Http\Controllers\CampController::class,'form_camp_penal'])->middleware(['auth', 'verified','admin'])->name('form_camp_penal');

Route::post('/Modifier-Utilisateur-form',[\App\Http\Controllers\UsersController::class,'FormUpdateUsers'])->middleware(['auth', 'verified','admin'])->name('ModifierUsers');

Route::post('/Modifier-Camp-form',[\App\Http\Controllers\CampController::class,'FormUpdateCamp'])->middleware(['auth', 'verified','admin'])->name('ModifierCamp');

Route::post('/Ajout-culture-form',[\App\Http\Controllers\CampController::class,'FormAddCulture'])->middleware(['auth', 'verified','admin'])->name('Ajout-culture');

Route::post('/Ajout-situation',[\App\Http\Controllers\CampController::class,'SaveSituation'])->middleware(['auth', 'verified','admin'])->name('AjoutSituation');

Route::post('/Ajout-info-Camp',[\App\Http\Controllers\CampController::class,'SaveInfo'])->middleware(['auth', 'verified','admin'])->name('AjoutInfo');

Route::post('/Ajout-culture',[\App\Http\Controllers\CultureController::class,'AddCulture'])->middleware(['auth', 'verified','admin'])->name('AjoutCulture');

Route::post('/Modifier-culture',[\App\Http\Controllers\CultureController::class,'FormUpdateCulture'])->middleware(['auth', 'verified','admin'])->name('ModifierCulture');

//AUTRE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
