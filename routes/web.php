<?php

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistorypengajuanController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\CommodityMasterController;
use App\Http\Controllers\HistorykalibrasiController;
use App\Http\Controllers\SertifikatMasterController;
use App\Http\Controllers\UserFormController;
use App\Http\Controllers\UserFormKalibrasiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VerificationAccountController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\KontakController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    $user = Auth::user();
    if ($user->roles->contains('name', 'Admin')) {
        return redirect('user-management')->with('user', $user);
    } else if ($user->roles->contains('name', 'User')) {
        return redirect('report-user')->with('user', $user);
    } else {
        return redirect('history-pengajuan')->with('user', $user);
    }
})->middleware('auth');

Route::get('/forgot-password', [ResetPassword::class, 'show'])->name('password.request');
Route::post('/forgot-password', [ResetPassword::class, 'postForgotPassword'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPassword::class, 'getResetPasswordToken'])->name('password.reset');
Route::post('/reset-password', [ResetPassword::class, 'postResetPasswordToken'])->name('password.update');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/report-user', [ReportController::class, 'index'])->name('report-user');
    Route::get('/report-user/search', [ReportController::class, 'search'])->name('searchReport');
    Route::get('/report-kalibrasi-user', [ReportController::class, 'indexkalibrasi'])->name('report-kalibrasi-user');
    Route::get('/report-kalibrasi-user/search', [ReportController::class, 'searchkalibrasi'])->name('searchReportKalibrasi');
    Route::get('/print-pdf/{id}', [ReportController::class, 'printpdf'])->name('print-pdf');
    Route::get('/print-file-analisa/{id}', [ReportController::class, 'printfileanalisa'])->name('print-file-analisa');

    Route::get('/survey/pengujian', [SurveyController::class, 'index'])->name('form-survey');
    Route::post('/survey/pengujian/submit', [SurveyController::class, 'store'])->name('form-survey.submit');
    Route::post('/survey/pengujian/submit2', [SurveyController::class, 'store2'])->name('form-survey.submit2');
    Route::get('/survey/kalibrasi', [SurveyController::class, 'indexKalibrasi'])->name('form-survey-kalibrasi');
    Route::post('/survey/kalibrasi/submit', [SurveyController::class, 'storeKalibrasi'])->name('form-survey-kalibrasi.submit');
    Route::get('/survey/export', [SurveyController::class, 'exportToExcel'])->name('export-survey');

    Route::get('/form', [UserFormController::class, 'show'])->name('form');
    Route::post('/form', [UserFormController::class, 'store'])->name('form.create');

    Route::get('/formkalibrasi', [UserFormKalibrasiController::class, 'show'])->name('formkalibrasi');
    Route::post('/formkalibrasi', [UserFormKalibrasiController::class, 'store'])->name('formkalibrasi.create');

    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');

    Route::get('/verification-account', [VerificationAccountController::class, 'index'])->name('verification-index');
    Route::post('/verification-account/approve/{id}', [VerificationAccountController::class, 'approve'])->name('verification-account.approve');

    Route::get('/user-management', [UserController::class, 'index'])->name('user-management');
    Route::delete('/user-management/{id}', [UserController::class, 'delete'])->name('user-management.delete');
    Route::get('/user-management/{id}/edit', [UserController::class, 'edit'])->name('user-management.edit');
    Route::put('/user-management/{id}', [UserController::class, 'update'])->name('user-management.update');
    Route::get('/user-management/create', [UserController::class, 'create'])->name('user-management.create');
    Route::post('/user-management', [UserController::class, 'store'])->name('user-management.store');

    Route::get('/commodity', [CommodityMasterController::class, 'index'])->name('commodity');
    Route::get('/commodity/create', [CommodityMasterController::class, 'create'])->name('commodity.create');
    Route::post('/commodity', [CommodityMasterController::class, 'store'])->name('commodity.store');
    Route::delete('/commodity/{id}', [CommodityMasterController::class, 'delete'])->name('commodity.delete');
    Route::get('/commodity/{id}/edit', [CommodityMasterController::class, 'edit'])->name('commodity.edit');
    Route::put('/commodity/{id}', [CommodityMasterController::class, 'update'])->name('commodity.update');

    Route::get('/data-sertifikat', [SertifikatMasterController::class, 'show'])->name('data-sertifikat');
    Route::post('/data-sertifikat', [SertifikatMasterController::class, 'createOrUpdate'])->name('data-sertifikat.create');
    Route::post('/data-sertifikat/update', [SertifikatMasterController::class, 'update'])->name('data-sertifikat.update');

    Route::get('/logo', [LogoController::class, 'show'])->name('logo');
    Route::post('/data-logo', [LogoController::class, 'createOrUpdate'])->name('data-logo.create');

    Route::get('/kontak', [KontakController::class, 'show'])->name('kontak');
    Route::post('/kontak', [KontakController::class, 'createOrUpdate'])->name('kontak.create');
    Route::post('/kontak/update', [KontakController::class, 'update'])->name('kontak.update');

    Route::get('/profile-user', [UserController::class, 'profileuser'])->name('profile-user');
    Route::put('/profile-user/{id}', [UserController::class, 'profileupdate'])->name('profile-user.update');

    Route::get('/review-user', [SurveyController::class, 'indexhome'])->name('review-user');
    Route::get('/review-user-search', [SurveyController::class, 'indexsearch'])->name('review-user-search');

    Route::get('/history-kalibrasi', [HistorykalibrasiController::class, 'index'])->name('history-kalibrasi');
    Route::get('/history-kalibrasi/search', [HistorykalibrasiController::class, 'search'])->name('searchKalibrasi');
    Route::get('/history-kalibrasi/{id}/edit', [HistorykalibrasiController::class, 'edit'])->name('history-kalibrasi.edit');
    Route::put('/history-kalibrasi/{id}', [HistorykalibrasiController::class, 'update'])->name('history-kalibrasi.update');
    Route::get('/history-kalibrasi/export', [HistorykalibrasiController::class, 'exportToExcel'])->name('export-history-kalibrasi');
    Route::post('/history-kalibrasi/upload', [HistorykalibrasiController::class, 'uploadPhoto'])->name('uploadkalibrasi.photo');
    Route::post('/history-kalibrasi/uploadLaporan', [HistorykalibrasiController::class, 'uploadLaporan'])->name('uploadkalibrasi.laporan');
    Route::post('/history-kalibrasi/uploadAnalis', [HistorykalibrasiController::class, 'uploadAnalis'])->name('uploadkalibrasi.Analis');

    Route::get('/history-pengajuan', [HistorypengajuanController::class, 'index'])->name('history-pengajuan');
    Route::get('/history-pengajuan/search', [HistorypengajuanController::class, 'search'])->name('searchPengajuan');
    Route::get('/history-pengajuan/{id}/edit', [HistorypengajuanController::class, 'edit'])->name('history-pengajuan.edit');
    Route::get('/history-pengajuan/{id}/sertif', [HistorypengajuanController::class, 'sertif'])->name('history-pengajuan.sertif');
    Route::get('/history-pengajuan/{id}/laporan', [HistorypengajuanController::class, 'laporan'])->name('history-pengajuan.laporan');
    Route::put('/history/{id}', [HistorypengajuanController::class, 'update'])->name('history-pengajuan.update');
    Route::put('/historysertif/{id}', [HistorypengajuanController::class, 'updatesertif'])->name('history-pengajuan.updatesertif');
    Route::put('/historylaporan/{id}', [HistorypengajuanController::class, 'updatelaporan'])->name('history-pengajuan.updatelaporan');
    Route::get('/history-pengajuan/export', [HistorypengajuanController::class, 'exportToExcel'])->name('export-history-pengajuan');
    Route::post('/history-pengajuan/upload', [HistorypengajuanController::class, 'uploadPhoto'])->name('upload.photo');
    Route::post('/history-pengajuan/uploadLaporan', [HistorypengajuanController::class, 'uploadLaporan'])->name('upload.laporan');
    Route::post('/history-pengajuan/uploadAnalis', [HistorypengajuanController::class, 'uploadAnalis'])->name('uploadpengajuan.Analis');
    Route::delete('/history-pengajuan/deleteAnalis/{id}', [HistoryPengajuanController::class, 'deleteAnalis']);
    Route::delete('/history-pengajuan/deleteLaporan/{id}', [HistoryPengajuanController::class, 'deleteLaporan']);
    Route::delete('/history-pengajuan/delete/{id}', [HistoryPengajuanController::class, 'delete']);

    Route::post('/approve/{id}', [HistorypengajuanController::class, 'approve'])->name('approve');
    Route::post('/approveBayar', [HistorypengajuanController::class, 'approveBayar'])->name('approveBayar');
    Route::post('/approveBayarAdmin', [HistorypengajuanController::class, 'approveBayarAdmin'])->name('approveBayarAdmin');

    Route::post('/approvekalibrasi/{id}', [HistorykalibrasiController::class, 'approvekalibrasi'])->name('approvekalibrasi');
    Route::post('/approvekalibrasiBayar', [HistorykalibrasiController::class, 'approvekalibrasiBayar'])->name('approvekalibrasiBayar');
    Route::post('/approvekalibrasiBayarAdmin', [HistorykalibrasiController::class, 'approvekalibrasiBayarAdmin'])->name('approvekalibrasiBayarAdmin');

    Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
