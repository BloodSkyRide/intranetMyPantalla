<?php
use App\Http\Controllers\tokenController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\historySubLaborsController;
use App\Http\Controllers\subLaborsController;
use App\Http\Controllers\laborController;
use App\Http\Controllers\assistController;
use App\Http\Controllers\userController;
use App\Http\Controllers\scheduleController;




use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("home");



//Route::post('/token', [tokenController::class, 'token'])->name("token");
Route::post('/login', [AuthController::class, 'login']);


Route::post('/logout', [AuthController::class, 'logout'])->name("logout")->middleware(["verifyTokenHeader"]);


Route::get('/refresh', [AuthController::class, 'refresh'])->middleware(["verificar_token"]);

Route::get('/me', [AuthController::class, 'me'])->middleware(["verificar_token"]);
Route::get('/dashboard', [dashboardController::class, 'openView'])->name("dashboard")->middleware(["verificar_token"]);
Route::get('/registerUser', [dashboardController::class, 'viewRegister'])->name("registroUser")->middleware(["verifyTokenHeader"]);

Route::post('/saveUser', [dashboardController::class, 'saveUser'])->name("saveUser")->middleware(["verifyTokenHeader"]);



Route::get('/showManageLabor', [dashboardController::class, 'showManageLabor'])->name("showManageLabor")->middleware(["verifyTokenHeader"]); //verificador de middleware

Route::get('/showAssists', [dashboardController::class, 'getShowAssist'])->name("getShowAssist")->middleware(["verifyTokenHeader"]);

Route::get('/showMyLabors', [dashboardController::class, 'getShowMyLabors'])->name("showMyLabors")->middleware(["verifyTokenHeader"]);

Route::post('/insertSubLabor', [subLaborsController::class, 'insertSubLabor'])->name("insertSubLabor")->middleware(["verifyTokenHeader"]);

Route::delete('/Deletes', [subLaborsController::class, 'deleteSubLabors'])->name("Deletes")->middleware(["verifyTokenHeader"]);

Route::post('/insertlabor', [laborController::class, 'insertLabor'])->name("insertlabor")->middleware(["verifyTokenHeader"]);

Route::put('/modifylabor', [laborController::class, 'editLabor'])->name("editLabor")->middleware(["verifyTokenHeader"]);

Route::post('/historySubLabor', [subLaborsController::class, 'historySubLabor'])->name("historySubLabor")->middleware(["verifyTokenHeader"]);

Route::put('/rechargeSubLabors', [subLaborsController::class, 'rechargeSubLabors'])->name("rechargeSubLabors")->middleware(["verifyTokenHeader"]);

Route::post('/captureHour', [assistController::class, 'captureHour'])->name("captureHour")->middleware(["verifyTokenHeader"]);

Route::get('/historyLabors', [historySubLaborsController::class, 'getShowHistorySubLabors'])->name("getShowHistorySubLabors")->middleware(["verifyTokenHeader"]);
Route::get('/searchForRange', [historySubLaborsController::class, 'searchForRange'])->name("searchForRange")->middleware(["verifyTokenHeader"]);

Route::get('/searchText', [historySubLaborsController::class, 'searchText'])->name("searchText")->middleware(["verifyTokenHeader"]);

Route::post('/collectSubLabors', [historySubLaborsController::class, 'collectSubLabors'])->name("collectSubLabors")->middleware(["verifyTokenHeader"]);

Route::put('/secure', [assistController::class, 'secure'])->name("secure")->middleware(["verifyTokenHeader"]);

Route::get('/getshowreportassists', [assistController::class, 'getShowReportAssists'])->name("getShowReportAssists")->middleware(["verifyTokenHeader"]);



Route::get('/getshowusers', [dashboardController::class, 'getShowUserAdmin'])->name("getShowUsers")->middleware(["verifyTokenHeader"]);


Route::get('/getUser', [userController::class, 'getUserForId'])->name("getUserForId")->middleware(["verifyTokenHeader"]);


Route::put('/modifyuser', [userController::class, 'modifyUser'])->name("modifyUser")->middleware(["verifyTokenHeader"]);

Route::delete('/deleteuser', [userController::class, 'deleteUser'])->name("deleteUser")->middleware(["verifyTokenHeader"]);

Route::put('/changePasswordShow', [dashboardController::class, 'changePasswordShow'])->name("changePasswordShow")->middleware(["verifyTokenHeader"]);

Route::put('/changepassword', [userController::class, 'changePassword'])->name("changePassword")->middleware(["verifyTokenHeader"]);



Route::get('/shownotices', [dashboardController::class, 'getShowNotices'])->name("getShowNotices")->middleware(["verifyTokenHeader"]);

Route::get('/showrangeassists', [assistController::class, 'getShowAssistRange'])->name("showrangeassists")->middleware(["verifyTokenHeader"]);

Route::get('/schedules', [scheduleController::class, 'getShowSchedule'])->name("getShowSchedule")->middleware(["verifyTokenHeader"]);

Route::put('/insertSchedule', [scheduleController::class, 'insertSchedule'])->name("insertSchedule")->middleware(["verifyTokenHeader"]);

Route::post('/scheduleclear', [scheduleController::class, 'scheduleclear'])->name("scheduleclear")->middleware(["verifyTokenHeader"]);

Route::put('/deleteclear', [scheduleController::class, 'deleteclear'])->name("deleteclear")->middleware(["verifyTokenHeader"]);



