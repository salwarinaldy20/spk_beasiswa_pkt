<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ACLController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Master\PenyakitController;
use App\Http\Controllers\Master\RulesController;
use App\Http\Controllers\Master\GejalaController;
use App\Http\Controllers\Transaksi\DiagnosaController;
use App\Http\Controllers\Transaksi\TrainingController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'App\Http\Middleware\SecureUrl'], function(){

	Route::get('/', [HomeController::class, 'landing'])->name('landing');
	Route::get('/signin', [HomeController::class, 'signin'])->name('signin');
	Route::get('/signup', [HomeController::class, 'signup'])->name('signup');
	Route::post('/auth', [VerifController::class, 'validasi'])->name('validasi');
	Route::post('/register', [VerifController::class, 'registerUser'])->name('registerUser');
	Route::get('/auth/google', [VerifController::class, 'redirectToGoogle'])->name('authgoogle');
    Route::get('/auth/google/callback', [VerifController::class, 'handleGoogleCallback'])->name('authgooglecallback');

});

Route::group(['middleware' => 'App\Http\Middleware\CheckSign'], function(){

    Route::get('/logout', [VerifController::class, 'logout'])->name('logout');


	Route::prefix('app')->group(function () {

		//PROFILE
		Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
		Route::post('/setprofile', [ProfileController::class, 'setProfile'])->name('setProfile');
		Route::post('/setavatar', [ProfileController::class, 'setAvatar'])->name('setAvatar');

		//MAIN
		Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');//->middleware('CheckPermission:dashboardRead');

		//SETTING : ACL ROLE & PERMISSION
		Route::get('/acl', [ACLController::class, 'aclRole'])->name('aclRole');//->middleware('CheckPermission:roleRead');
		Route::post('/getdatarole', [ACLController::class, 'getDataRole'])->name('getDataRole');//->middleware('CheckPermission:roleRead');
		Route::post('/getlistrole', [ACLController::class, 'getListRole'])->name('getListRole');//->middleware('CheckPermission:roleRead');;
		Route::post('/fdatarole', [ACLController::class, 'fdataRole'])->name('fdataRole');//->middleware('CheckPermission:roleRead');
		Route::post('/ucrole', [ACLController::class, 'ucRole'])->name('ucRole');//->middleware('CheckPermission:roleUpdate|roleCreate');
		Route::post('/delrole', [ACLController::class, 'delRole'])->name('delRole');//->middleware('CheckPermission:roleDelete');

		Route::post('/getdatapermission', [ACLController::class, 'getDataPermission'])->name('getDataPermission');//->middleware('CheckPermission:permissionRead');
		Route::post('/getlistpermission', [ACLController::class, 'getListPermission'])->name('getListPermission');//->middleware('CheckPermission:permissionRead');
		Route::post('/fdatapermission', [ACLController::class, 'fdataPermission'])->name('fdataPermission');//->middleware('CheckPermission:permissionRead');
		Route::post('/ucpermission', [ACLController::class, 'ucPermission'])->name('ucPermission');//->middleware('CheckPermission:permissionCreate|permissionUpdate');
		Route::post('/delpermission', [ACLController::class, 'delPermission'])->name('delPermission');//->middleware('CheckPermission:permissionDelete');

		//RESOURCES : USERS
		Route::get('/user', [UserController::class, 'user'])->name('user');//->middleware('CheckPermission:userRead');
		Route::post('/getdatauser', [UserController::class, 'getDataUser'])->name('getDataUser');//->middleware('CheckPermission:userRead');
		Route::post('/setactiveuser', [UserController::class, 'setActiveUser'])->name('setActiveUser');//->middleware('CheckPermission:userUpdate');
		Route::post('/ucuser', [UserController::class, 'ucUser'])->name('ucUser');//->middleware('CheckPermission:userCreate|userUpdate');
		Route::post('/fdatauser', [UserController::class, 'fdataUser'])->name('fdataUser');//->middleware('CheckPermission:userRead');
		Route::post('/deluser', [UserController::class, 'delUser'])->name('delUser');//->middleware('CheckPermission:userDelete');

        //RESOURCES : Penyakit
		Route::get('/penyakit', [PenyakitController::class, 'penyakit'])->name('penyakit');//->middleware('CheckPermission:penyakitRead');
		Route::post('/getdatapenyakit', [PenyakitController::class, 'getDataPenyakit'])->name('getDataPenyakit');//->middleware('CheckPermission:penyakitRead');
		Route::post('/setactivepenyakit', [PenyakitController::class, 'setActivePenyakit'])->name('setActivePenyakit');//->middleware('CheckPermission:penyakitUpdate');
		Route::post('/ucpenyakit', [PenyakitController::class, 'ucPenyakit'])->name('ucPenyakit');//->middleware('CheckPermission:penyakitCreate|penyakitUpdate');
		Route::post('/fdatapenyakit', [PenyakitController::class, 'fdataPenyakit'])->name('fdataPenyakit');//->middleware('CheckPermission:penyakitRead');
		Route::post('/delpenyakit', [PenyakitController::class, 'delPenyakit'])->name('delPenyakit');//->middleware('CheckPermission:penyakitDelete');

        //RESOURCES : Rules
		Route::get('/gejala', [GejalaController::class, 'gejala'])->name('gejala');//->middleware('CheckPermission:gejalaRead');
		Route::post('/getdatagejala', [GejalaController::class, 'getDataGejala'])->name('getDataGejala');//->middleware('CheckPermission:gejalaRead');
		Route::post('/setactivegejala', [GejalaController::class, 'setActiveGejala'])->name('setActiveGejala');//->middleware('CheckPermission:gejalaUpdate');
		Route::post('/ucgejala', [GejalaController::class, 'ucGejala'])->name('ucGejala');//->middleware('CheckPermission:gejalaCreate|gejalaUpdate');
		Route::post('/fdatagejala', [GejalaController::class, 'fdataGejala'])->name('fdataGejala');//->middleware('CheckPermission:gejalaRead');
		Route::post('/delgejala', [GejalaController::class, 'delGejala'])->name('delGejala');//->middleware('CheckPermission:penyakitDelete');

        //RESOURCES : Gejala
		Route::get('/rules', [RulesController::class, 'rules'])->name('rules');//->middleware('CheckPermission:rulesRead');
		Route::post('/getdatarules', [RulesController::class, 'getDataRules'])->name('getDataRules');//->middleware('CheckPermission:rulesRead');
		Route::post('/setactiverules', [RulesController::class, 'setActiveRules'])->name('setActiveRules');//->middleware('CheckPermission:rulesUpdate');
		Route::post('/ucrules', [RulesController::class, 'ucRules'])->name('ucRules');//->middleware('CheckPermission:rulesCreate|rulesUpdate');
		Route::post('/fdatarules', [RulesController::class, 'fdataRules'])->name('fdataRules');//->middleware('CheckPermission:rulesRead');
		Route::post('/delrules', [RulesController::class, 'delRules'])->name('delRules');//->middleware('CheckPermission:penyakitDelete');

        //TRANSAKSI: DATA TRAINING
        Route::get('/training', [TrainingController::class, 'training'])->name('training');//->middleware('CheckPermission:trainingRead');
		Route::post('/getdatatraining', [TrainingController::class, 'getDataTraining'])->name('getDataTraining');//->middleware('CheckPermission:trainingRead');
		Route::post('/uctraining', [TrainingController::class, 'ucTraining'])->name('ucTraining');//->middleware('CheckPermission:trainingCreate|trainingUpdate');
		Route::post('/fdatatraining', [TrainingController::class, 'fdataTraining'])->name('fdataTraining');//->middleware('CheckPermission:trainingRead');
		Route::post('/deltraining', [TrainingController::class, 'delTraining'])->name('delTraining');//->middleware('CheckPermission:penyakitDelete');

        //RESOURCES: Diagnosa Pasien
        Route::get('/diagnosa', [DiagnosaController::class, 'diagnosa'])->name('diagnosa');//->middleware('CheckPermission:diagnosaRead');
		Route::post('/prosesdiagnosa', [DiagnosaController::class, 'prosesDiagnosa'])->name('prosesDiagnosa');//->middleware('CheckPermission:diagnosaRead');
		Route::post('/getdatadiagnosa', [DiagnosaController::class, 'getDataDiagnosa'])->name('getDataDiagnosa');//->middleware('CheckPermission:diagnosaRead');
		Route::post('/setactivediagnosa', [DiagnosaController::class, 'setActiveDiagnosa'])->name('setActiveDiagnosa');//->middleware('CheckPermission:diagnosaUpdate');
		Route::post('/ucdiagnosa', [DiagnosaController::class, 'ucDiagnosa'])->name('ucDiagnosa');//->middleware('CheckPermission:diagnosaCreate|diagnosaUpdate');
		Route::post('/fdatadiagnosa', [DiagnosaController::class, 'fdataDiagnosa'])->name('fdataDiagnosa');//->middleware('CheckPermission:diagnosaRead');
		Route::post('/deldiagnosa', [DiagnosaController::class, 'delDiagnosa'])->name('delDiagnosa');//->middleware('CheckPermission:penyakitDelete');

	});




});

