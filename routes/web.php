<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\patrolEHSController;
use App\Http\Controllers\excelController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\genbaController;

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


Route::middleware('auth')->group(function () {
    Route::get('/table', [LaporanController::class, 'index'])->name('gettable');
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/activity-logbs', [SettingController::class, 'table_activity']);
     
    Route::match(['GET','HEAD'],'/', [UserController::class, 'awal'])->name('awal');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('HOME');
    Route::get('/alltable', [LaporanController::class, 'index_all']);
    Route::get('/patrolEHS', [patrolEHSController::class, 'index'])->name('patrolEhs');
    Route::get('/alltabletest', [LaporanController::class, 'index_all_test']);
    Route::get('/detail/{id}', [LaporanController::class, 'detail'])->name('detailLaporan');
    Route::get('/patrolEHS/{id}', [patrolEHSController::class, 'detail'])->name('patrolEhsDetail');
    Route::post('/export', [excelController::class, 'export'])->name('exportLaporan');
    Route::post('/genba_export', [excelController::class, 'genba_export']);
    
    Route::group(['middleware' => ['role:EHS']], function () {
        Route::post('/needApproveTemuanEHS', [patrolEHSController::class, 'needApproveTemuanEHS']);
        Route::post('/needApproveTemuanEHSAll', [patrolEHSController::class, 'needApproveTemuanEHSAll'])->name('needApproveTemuanEhsAll');
        Route::get('/createPatrol', [patrolEHSController::class, 'create'])->name('createPatrol');
        Route::get('/patrolEHS/destroy/{id}', [patrolEHSController::class, 'destroy'])->name('hapusLaporan');
        Route::get('/patrolEHS/edit/{id}', [patrolEHSController::class, 'edit'])->name('patrolEhsEdit');
        Route::post('/patrolEHS/update', [patrolEHSController::class, 'update'])->name('patrolEhsUpdate');
        Route::post('/patrolEHS/createPatrol', [patrolEHSController::class, 'store'])->name('createPatrolStore');
        Route::get('/createform/{id}', [LaporanController::class, 'create'])->name('createForm');
        Route::post('/createform', [LaporanController::class, 'store'])->name('createFormStore');
        Route::post('/verify-laporan', [LaporanController::class, 'verify_laporan'])->name('verify-laporan');
        // management patrol
        Route::get('/genba/schedule/create',[genbaController::class, 'createSchedule']);
        Route::post('/genba/schedule/store',[genbaController::class, 'storeSchedule']);
        Route::post('/genba/schedule/update',[genbaController::class, 'updateSchedule']);
        Route::get('/genba/schedule/edit/{id}', [genbaController::class, 'editSchedule']);
        Route::get('/genba/schedule/delete/{id}', [genbaController::class, 'destroySchedule']);
        Route::get('/genba/team', [genbaController::class, 'indexTeam']);
        Route::get('/genba/team/create', [genbaController::class, 'createTeam']);
        Route::post('/genba/team/store', [genbaController::class, 'storeTeam']);
        Route::post('/genba/team/update', [genbaController::class, 'updateTeam']);
        Route::get('/genba/team/delete/{id}', [genbaController::class, 'destroyTeam']);
        Route::get('/genba/team/edit/{id}', [genbaController::class, 'editTeam']);
        Route::get('/genba/team/{id}', [genbaController::class, 'detailTeam']);
        
    });
    Route::group(['middleware' => ['role:EHS|Departement Head EHS|Departement Head PIC']], function () {
        Route::get('/tolak-laporan/{id}', [LaporanController::class, 'create_penolakan'])->name('createPenolakan');
        Route::post('/tolak-laporan', [LaporanController::class, 'update_tolak_laporan'])->name('updateTolakLaporan');
        Route::post('/ApprovedDeptHeadEHS', [patrolEHSController::class, 'ApprovedDeptHeadEHS']);
        Route::post('/ApprovedDeptHeadEHSAll', [patrolEHSController::class, 'ApprovedDeptHeadEHSAll'])->name('approveDeptheadEhsAll');
    });

    Route::group(['middleware' => ['role:Departement Head PIC']], function () {
        Route::post('/needVerifyEHS', [patrolEHSController::class, 'needVerifyEHS']);
        Route::post('/needVerifyEHSAll', [patrolEHSController::class, 'needVerifyEHSAll'])->name('needVerifikasiEhsAll');
    });

    Route::group(['middleware' => ['role:EHS|Departement Head EHS']], function () {
        Route::post('/updateform', [LaporanController::class, 'update'])->name('updateForm');
        Route::get('/editForm/{id}', [LaporanController::class, 'edit'])->name('editForm');
    });  
    Route::post('/hapus-laporan', [LaporanController::class, 'destroy']);

    Route::group(['middleware' => ['role:EHS|Departement Head EHS']], function () {
        Route::post('/Dept.Head.EHS/Submit', [LaporanController::class, 'Accept_EHS'])->name('deptHeadEhsSubmit');
    });  

    Route::group(['middleware' => ['role:PIC']], function () {
        Route::post('/needApproveTemuanPIC', [patrolEHSController::class, 'needApproveTemuanPIC'])->name('needApproveTemuanPic');
        Route::post('/needApproveTemuanPICALL', [patrolEHSController::class, 'needApproveTemuanPICALL'])->name('needApproveTemuanPICALL');
        Route::get('/laporan_penanggulangan/edit/{id}', [LaporanController::class, 'edit_laporan_penanggulangan']);
        Route::post('/laporan_penanggulangan/Update', [LaporanController::class, 'update_laporan_penanggulangan']);
        Route::get('/laporan_penanggulangan/{id}', [LaporanController::class, 'create_laporan_penanggulangan'])->name('createLaporanPenanggulangan');
    });  
    
    Route::group(['middleware' => ['role:Departement Head PIC|PIC']], function () {
        Route::post('/laporan_penanggulangan/store', [LaporanController::class, 'Store_laporan_penanggulangan'])->name('laporanPenanggulanganStore');
        Route::get('/laporan_penanggulangan/{id}', [LaporanController::class, 'create_laporan_penanggulangan']);
        Route::post('/Dept.Head.PIC/Submit', [LaporanController::class, 'Accept_PIC'])->name('deptHeadPicSubmit');
    });  
    
    Route::group(['middleware' => ['role:Admin|EHS']], function () {
        Route::get('/karyawan/create', [SettingController::class, 'createKaryawan'])->name('createKaryawan');
        Route::post('/karyawan/store', [SettingController::class, 'storeKaryawan'])->name('storeKaryawan');
        Route::get('/karyawan', [SettingController::class, 'indexKaryawan']);
        Route::get('/karyawan/detail/{id}', [SettingController::class, 'detailKaryawan'])->name('detailKaryawan');
        Route::get('/karyawan/edit/{id}', [SettingController::class, 'editKaryawan'])->name('editKaryawan');
        Route::post('/karyawan/update/{id}', [SettingController::class, 'updateKaryawan'])->name('updateKaryawan');
        Route::post('/karyawan/delete', [SettingController::class, 'deleteKaryawan'])->name('deleteKaryawan');
        
        Route::post('/area/store', [SettingController::class, 'storeArea'])->name('areaStore');
        Route::get('/area', [SettingController::class, 'indexArea']);
        Route::post('/area/delete', [SettingController::class, 'deleteArea']);
        Route::post('/area/pic-assign', [SettingController::class, 'pic_assign'])->name('picAssign');
        Route::post('/area/remove-area-pic', [SettingController::class, 'pic_remove_area'])->name('removeAreaPic');
    });
    //management patrol
    Route::get('/genba/schedule', [genbaController::class, 'indexSchedule']);
    Route::get('/genba/laporan/{id}', [genbaController::class, 'genbaDetail']);
    
    Route::get('/genba/table', [genbaController::class, 'tableTemuan']);
    Route::get('/genba/laporan/createTemuan/{id}', [genbaController::class, 'createTemuan']);
    Route::post('/genba/laporan/storeTemuan', [genbaController::class, 'storeTemuan']);
    Route::post('/genba/laporan/updateTemuan', [genbaController::class, 'updateTemuan']);
    Route::get('/genba/laporan/temuan/edit/{id}', [genbaController::class, 'editTemuan']);
    Route::get('/genba/laporan/temuan/{id}', [genbaController::class, 'detailTemuan'])->name('detailTemuan');

    Route::get('/genba/laporan/{idGenba}/penilaian/detail/{detail_id}', [genbaController::class, 'detailPenilaian']);
    Route::get('/genba/laporan/{idGenba}/penilaian/edit/{detail_id}', [genbaController::class, 'editPenilaian']);
    Route::get('/genba/laporan/{idGenba}/penilaian/{detail_id}', [genbaController::class, 'createPenilaian']);
    Route::post('/genba/penilaian/update', [genbaController::class, 'updatePenilaian']);
    Route::post('/genba/penilaian/store', [genbaController::class, 'storePenilaian']);

   
    
});

Route::middleware('guest')->group(function () {
    
    Route::get('/login', [UserController::class, 'home'])->name('login');
    Route::post('/login-prosess', [UserController::class, 'login'])->name('login.auth');
});

