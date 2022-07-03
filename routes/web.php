<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ACLController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Master\RulesController;
use App\Http\Controllers\Master\AtributController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\KriteriaController;
use App\Http\Controllers\Master\PenilaianController;
use App\Http\Controllers\Master\PeriodeController;
use App\Http\Controllers\Transaksi\DiagnosaController;
use App\Http\Controllers\Transaksi\TrainingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" mid
dleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'App\Http\Middleware\SecureUrl'], function(){

	Route::get('/', [HomeController::class, 'signin'])->name('signin');
	Route::post('/auth', [VerifController::class, 'validasi'])->name('validasi');
	// Route::get('/auth/google', [VerifController::class, 'redirectToGoogle'])->name('authgoogle');
    // Route::get('/auth/google/callback', [VerifController::class, 'handleGoogleCallback'])->name('authgooglecallback');

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

        //RESOURCES : Kategori
		Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');//->middleware('CheckPermission:kategoriRead');
		Route::post('/getdatakategori', [KategoriController::class, 'getDataKategori'])->name('getDataKategori');//->middleware('CheckPermission:kategoriRead');
		Route::post('/setactivekategori', [KategoriController::class, 'setActiveKategori'])->name('setActiveKategori');//->middleware('CheckPermission:kategoriUpdate');
		Route::post('/uckategori', [KategoriController::class, 'ucKategori'])->name('ucKategori');//->middleware('CheckPermission:kategoriCreate|kategoriUpdate');
		Route::post('/fdatakategori', [KategoriController::class, 'fdataKategori'])->name('fdataKategori');//->middleware('CheckPermission:kategoriRead');
		Route::post('/delkategori', [KategoriController::class, 'delKategori'])->name('delKategori');//->middleware('CheckPermission:kategoriDelete');

        //RESOURCES : Kriteria
		Route::get('/kriteria', [KriteriaController::class, 'kriteria'])->name('kriteria');//->middleware('CheckPermission:kriteriaRead');
		Route::post('/getdatakriteria', [KriteriaController::class, 'getDataKriteria'])->name('getDataKriteria');//->middleware('CheckPermission:kriteriaRead');
		Route::post('/setactivekriteria', [KriteriaController::class, 'setActiveKriteria'])->name('setActiveKriteria');//->middleware('CheckPermission:kriteriaUpdate');
		Route::post('/uckriteria', [KriteriaController::class, 'ucKriteria'])->name('ucKriteria');//->middleware('CheckPermission:kriteriaCreate|kriteriaUpdate');
		Route::post('/fdatakriteria', [KriteriaController::class, 'fdataKriteria'])->name('fdataKriteria');//->middleware('CheckPermission:kriteriaRead');
		Route::post('/delkriteria', [KriteriaController::class, 'delKriteria'])->name('delKriteria');//->middleware('CheckPermission:kriteriaDelete');

        //RESOURCES : Atribut
		Route::get('/atribut', [AtributController::class, 'atribut'])->name('atribut');//->middleware('CheckPermission:atributRead');
		Route::post('/getdataatribut', [AtributController::class, 'getDataAtribut'])->name('getDataAtribut');//->middleware('CheckPermission:atributRead');
		Route::post('/setactiveatribut', [AtributController::class, 'setActiveAtribut'])->name('setActiveAtribut');//->middleware('CheckPermission:atributUpdate');
		Route::post('/ucatribut', [AtributController::class, 'ucAtribut'])->name('ucAtribut');//->middleware('CheckPermission:atributCreate|atributUpdate');
		Route::post('/fdataatribut', [AtributController::class, 'fdataAtribut'])->name('fdataAtribut');//->middleware('CheckPermission:atributRead');
		Route::post('/delatribut', [AtributController::class, 'delAtribut'])->name('delAtribut');//->middleware('CheckPermission:kategoriDelete');

         //RESOURCES : Penilaian
		Route::get('/penilaian', [PenilaianController::class, 'penilaian'])->name('penilaian');//->middleware('CheckPermission:penilaianRead');
		Route::post('/getdatapenilaian', [PenilaianController::class, 'getDataPenilaian'])->name('getDataPenilaian');//->middleware('CheckPermission:penilaianRead');
		Route::post('/setactivepenilaian', [PenilaianController::class, 'setActivePenilaian'])->name('setActivePenilaian');//->middleware('CheckPermission:penilaianUpdate');
		Route::post('/ucpenilaian', [PenilaianController::class, 'ucPenilaian'])->name('ucPenilaian');//->middleware('CheckPermission:penilaianCreate|penilaianUpdate');
		Route::post('/fdatapenilaian', [PenilaianController::class, 'fdataPenilaian'])->name('fdataPenilaian');//->middleware('CheckPermission:penilaianRead');
		Route::post('/delpenilaian', [PenilaianController::class, 'delPenilaian'])->name('delPenilaian');//->middleware('CheckPermission:kategoriDelete');

         //RESOURCES : Periode
		Route::get('/periode', [PeriodeController::class, 'periode'])->name('periode');//->middleware('CheckPermission:periodeRead');
		Route::post('/getdataperiode', [PeriodeController::class, 'getDataPeriode'])->name('getDataPeriode');//->middleware('CheckPermission:periodeRead');
		Route::post('/setactiveperiode', [PeriodeController::class, 'setActivePeriode'])->name('setActivePeriode');//->middleware('CheckPermission:periodeUpdate');
		Route::post('/ucperiode', [PeriodeController::class, 'ucPeriode'])->name('ucPeriode');//->middleware('CheckPermission:periodeCreate|periodeUpdate');
		Route::post('/fdataperiode', [PeriodeController::class, 'fdataPeriode'])->name('fdataPeriode');//->middleware('CheckPermission:periodeRead');
		Route::post('/delperiode', [PeriodeController::class, 'delPeriode'])->name('delPeriode');//->middleware('CheckPermission:kategoriDelete');


        //RESOURCES : Rules
		Route::get('/rules', [RulesController::class, 'rules'])->name('rules');//->middleware('CheckPermission:rulesRead');
		Route::post('/getdatarules', [RulesController::class, 'getDataRules'])->name('getDataRules');//->middleware('CheckPermission:rulesRead');
		Route::post('/setactiverules', [RulesController::class, 'setActiveRules'])->name('setActiveRules');//->middleware('CheckPermission:rulesUpdate');
		Route::post('/ucrules', [RulesController::class, 'ucRules'])->name('ucRules');//->middleware('CheckPermission:rulesCreate|rulesUpdate');
		Route::post('/fdatarules', [RulesController::class, 'fdataRules'])->name('fdataRules');//->middleware('CheckPermission:rulesRead');
		Route::post('/delrules', [RulesController::class, 'delRules'])->name('delRules');//->middleware('CheckPermission:kategoriDelete');

        //TRANSAKSI: DATA TRAINING
        Route::get('/training', [TrainingController::class, 'training'])->name('training');//->middleware('CheckPermission:trainingRead');
		Route::post('/getdatatraining', [TrainingController::class, 'getDataTraining'])->name('getDataTraining');//->middleware('CheckPermission:trainingRead');
		Route::post('/uctraining', [TrainingController::class, 'ucTraining'])->name('ucTraining');//->middleware('CheckPermission:trainingCreate|trainingUpdate');
		Route::post('/fdatatraining', [TrainingController::class, 'fdataTraining'])->name('fdataTraining');//->middleware('CheckPermission:trainingRead');
		Route::post('/deltraining', [TrainingController::class, 'delTraining'])->name('delTraining');//->middleware('CheckPermission:kategoriDelete');

        //RESOURCES: Diagnosa Pasien
        Route::get('/diagnosa', [DiagnosaController::class, 'diagnosa'])->name('diagnosa');//->middleware('CheckPermission:diagnosaRead');
		Route::post('/prosesdiagnosa', [DiagnosaController::class, 'prosesDiagnosa'])->name('prosesDiagnosa');//->middleware('CheckPermission:diagnosaRead');
		Route::post('/getdatadiagnosa', [DiagnosaController::class, 'getDataDiagnosa'])->name('getDataDiagnosa');//->middleware('CheckPermission:diagnosaRead');
		Route::post('/setactivediagnosa', [DiagnosaController::class, 'setActiveDiagnosa'])->name('setActiveDiagnosa');//->middleware('CheckPermission:diagnosaUpdate');
		Route::post('/ucdiagnosa', [DiagnosaController::class, 'ucDiagnosa'])->name('ucDiagnosa');//->middleware('CheckPermission:diagnosaCreate|diagnosaUpdate');
		Route::post('/fdatadiagnosa', [DiagnosaController::class, 'fdataDiagnosa'])->name('fdataDiagnosa');//->middleware('CheckPermission:diagnosaRead');
		Route::post('/deldiagnosa', [DiagnosaController::class, 'delDiagnosa'])->name('delDiagnosa');//->middleware('CheckPermission:kategoriDelete');

	});




});

