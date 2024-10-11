<?php
use App\Http\Controllers\tokenController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\adminLaborsController;
use App\Http\Controllers\subLaborsController;
use App\Http\Controllers\laborController;




use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("home");



//Route::post('/token', [tokenController::class, 'token'])->name("token");
Route::post('/login', [AuthController::class, 'login']);


Route::post('/logout', [AuthController::class, 'logout'])->middleware(["verificar_token"]);
Route::get('/refresh', [AuthController::class, 'refresh'])->middleware(["verificar_token"]);

Route::get('/me', [AuthController::class, 'me'])->middleware(["verificar_token"]);
Route::get('/dashboard', [dashboardController::class, 'openView'])->name("dashboard")->middleware(["verificar_token"]);
Route::get('/registerUser', [dashboardController::class, 'viewRegister'])->name("registroUser");



Route::post('/saveUser', [dashboardController::class, 'saveUser'])->name("saveUser");

Route::get('/showManageLabor', [dashboardController::class, 'showManageLabor'])->name("showManageLabor");

Route::get('/showMyLabors', [dashboardController::class, 'getShowMyLabors'])->name("showMyLabors");

Route::post('/insertSubLabor', [subLaborsController::class, 'insertSubLabor'])->name("insertSubLabor");

Route::delete('/Deletes', [subLaborsController::class, 'deleteSubLabors'])->name("Deletes");

Route::post('/insertlabor', [laborController::class, 'insertLabor'])->name("insertlabor");


