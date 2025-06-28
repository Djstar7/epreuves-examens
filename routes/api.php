<?php
use Illuminate\Support\Facades\Route;
// Mettez à jour l'importation
use App\Http\Controllers\Api\BepcController;
use App\Http\Controllers\Api\BacGenController;
use App\Http\Controllers\Api\BacTechController;
use App\Http\Controllers\Api\BtsController;
use App\Http\Controllers\Api\CapController;
use App\Http\Controllers\Api\ConcoursController;
use App\Http\Controllers\Api\ProbatoireGenController;
use App\Http\Controllers\Api\ProbatoireTechController;

// Routes pour les épreuves BEPC
Route::prefix('bepc')->group(function () {
    Route::get('/', [BepcController::class, 'index']);          // Liste toutes les épreuves
    Route::post('/store', [BepcController::class, 'store']);         // Créer une nouvelle épreuve
    Route::get('/show/{id}', [BepcController::class, 'show']);       // Afficher une épreuve spécifique
    Route::put('/update/{id}', [BepcController::class, 'update']);     // Mettre à jour une épreuve
    Route::delete('/destroy/{id}', [BepcController::class, 'destroy']); // Supprimer une épreuve
});
// Routes pour les épreuves CAP
Route::prefix('cap')->group(function () {
    Route::get('/', [CapController::class, 'index']);
    Route::post('/store', [CapController::class, 'store']);
    Route::get('/show/{id}', [CapController::class, 'show']);
    Route::put('/update/{id}', [CapController::class, 'update']);
    Route::delete('/destroy/{id}', [CapController::class, 'destroy']);
});
// Routes pour les épreuves Probatoire Genéral
Route::prefix('probatoiregen')->group(function () {
    Route::get('/', [ProbatoireGenController::class, 'index']);
    Route::post('/store', [ProbatoireGenController::class, 'store']);
    Route::get('/show/{id}', [ProbatoireGenController::class, 'show']);
    Route::put('/update/{id}', [ProbatoireGenController::class, 'update']);
    Route::delete('/destroy/{id}', [ProbatoireGenController::class, 'destroy']);
});

// Routes pour les épreuves Probatoire Technique
Route::prefix('probatoiretech')->group(function () {
    Route::get('/', [ProbatoireTechController::class, 'index']);
    Route::post('/store', [ProbatoireTechController::class, 'store']);
    Route::get('/show/{id}', [ProbatoireTechController::class, 'show']);
    Route::put('/update/{id}', [ProbatoireTechController::class, 'update']);
    Route::delete('/destroy/{id}', [ProbatoireTechController::class, 'destroy']);
});

// Routes pour les épreuves BAC Genéral
Route::prefix('baccgen')->group(function () {
    Route::get('/', [BacGenController::class, 'index']);
    Route::post('/store', [BacGenController::class, 'store']);
    Route::get('/show/{id}', [BacGenController::class, 'show']);
    Route::put('/update/{id}', [BacGenController::class, 'update']);
    Route::delete('/destroy/{id}', [BacGenController::class, 'destroy']);
});

// Routes pour les épreuves BAC Technique
Route::prefix('bacctech')->group(function () {
    Route::get('/', [BacTechController::class, 'index']);
    Route::post('/store', [BacTechController::class, 'store']);
    Route::get('/show/{id}', [BacTechController::class, 'show']);
    Route::put('/update/{id}', [BacTechController::class, 'update']);
    Route::delete('/destroy/{id}', [BacTechController::class, 'destroy']);
});

// Routes pour les épreuves Concours
Route::prefix('concours')->group(function () {
    Route::get('/', [ConcoursController::class, 'index']);
    Route::post('/store', [ConcoursController::class, 'store']);
    Route::get('/show/{id}', [ConcoursController::class, 'show']);
    Route::put('/update/{id}', [ConcoursController::class, 'update']);
    Route::delete('/destroy/{id}', [ConcoursController::class, 'destroy']);
});
// Routes pour les épreuves BTS
Route::prefix('bts')->group(function () {
    Route::get('/', [BtsController::class, 'index']);
    Route::post('/store', [BtsController::class, 'store']);
    Route::get('/show/{id}', [BtsController::class, 'show']);
    Route::put('/update/{id}', [BtsController::class, 'update']);
    Route::delete('/destroy/{id}', [BtsController::class, 'destroy']);
});



