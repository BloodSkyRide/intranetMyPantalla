<?php
use App\Http\Controllers\tokenController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\historySubLaborsController;
use App\Http\Controllers\subLaborsController;
use App\Http\Controllers\laborController;
use App\Http\Controllers\assistController;




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

Route::get('/showManageLabor', [dashboardController::class, 'showManageLabor'])->name("showManageLabor"); //verificador de middleware

Route::get('/showAssists', [dashboardController::class, 'getShowAssist'])->name("getShowAssist")->middleware(["verifyTokenHeader"]);

Route::get('/showMyLabors', [dashboardController::class, 'getShowMyLabors'])->name("showMyLabors")->middleware(["verifyTokenHeader"]);

Route::post('/insertSubLabor', [subLaborsController::class, 'insertSubLabor'])->name("insertSubLabor");

Route::delete('/Deletes', [subLaborsController::class, 'deleteSubLabors'])->name("Deletes");

Route::post('/insertlabor', [laborController::class, 'insertLabor'])->name("insertlabor");

Route::post('/historySubLabor', [subLaborsController::class, 'historySubLabor'])->name("historySubLabor")->middleware(["verifyTokenHeader"]);

Route::put('/rechargeSubLabors', [subLaborsController::class, 'rechargeSubLabors'])->name("rechargeSubLabors")->middleware(["verifyTokenHeader"]);

Route::post('/captureHour', [assistController::class, 'captureHour'])->name("captureHour")->middleware(["verifyTokenHeader"]);

Route::get('/historyLabors', [historySubLaborsController::class, 'getShowHistorySubLabors'])->name("getShowHistorySubLabors")->middleware(["verifyTokenHeader"]);
Route::get('/searchForRange', [historySubLaborsController::class, 'searchForRange'])->name("searchForRange")->middleware(["verifyTokenHeader"]);

Route::get('/searchText', [historySubLaborsController::class, 'searchText'])->name("searchText")->middleware(["verifyTokenHeader"]);

Route::post('/collectSubLabors', [historySubLaborsController::class, 'collectSubLabors'])->name("collectSubLabors")->middleware(["verifyTokenHeader"]);


Route::get('/getshowreportassists', [assistController::class, 'getShowReportAssists'])->name("getShowReportAssists")->middleware(["verifyTokenHeader"]);



