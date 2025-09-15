<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaSt;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisHakController;
use App\Http\Controllers\KecamatanKelurahanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SeksiPelayananController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'landing'])->name('landing');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('getDetailDashboardGlobal', [HomeController::class, 'getDetailDashboardGlobal'])->name('getDetailDashboardGlobal');
    Route::get('getDetailDashboard', [PeminjamanController::class, 'getDetailDashboard'])->name('getDetailDashboard');

    Route::middleware('hakakses:1')->group(function () {
        //kecamatan Kelurahan
        Route::get('kecamatan-kelurahan', [KecamatanKelurahanController::class, 'index'])->name('kecamatanKelurahan');

        Route::get('get-data-kecamatan', [KecamatanKelurahanController::class, 'getDataKecamatan'])->name('getDataKecamatan');

        Route::post('add-kecamatan', [KecamatanKelurahanController::class, 'addKecamatan'])->name('addKecamatan');

        Route::get('get-kecamatan/{id}', [KecamatanKelurahanController::class, 'getKecamatan']);

        Route::post('edit-kecamatan', [KecamatanKelurahanController::class, 'editKecamatan'])->name('editKecamatan');

        Route::get('get-data-kelurahan', [KecamatanKelurahanController::class, 'getDataKelurahan'])->name('getDataKelurahan');

        Route::post('add-kelurahan', [KecamatanKelurahanController::class, 'addKelurahan'])->name('addKelurahan');

        Route::get('get-kelurahan/{id}', [KecamatanKelurahanController::class, 'getKelurahan']);

        Route::post('edit-kelurahan', [KecamatanKelurahanController::class, 'editKelurahan'])->name('editKelurahan');

        Route::get('find-kelurahan', [KecamatanKelurahanController::class, 'findKelurahan']);

        Route::get('get-list-kecamatan', [KecamatanKelurahanController::class, 'getListKecamatan'])->name('getListKecamatan');
        //end kecamatan keluarahan

        //seksi pelayanan
        Route::get('seksi-pelayanan', [SeksiPelayananController::class, 'index'])->name('seksiPelayanan');

        Route::get('get-data-seksi', [SeksiPelayananController::class, 'getDataSeksi'])->name('getDataSeksi');

        Route::post('add-seksi', [SeksiPelayananController::class, 'addSeksi'])->name('addSeksi');

        Route::get('get-seksi/{id}', [SeksiPelayananController::class, 'getSeksi']);

        Route::post('edit-seksi', [SeksiPelayananController::class, 'editSeksi'])->name('editSeksi');

        Route::get('get-data-pelayanan', [SeksiPelayananController::class, 'getDataPelayanan'])->name('getDataPelayanan');

        Route::post('add-pelayanan', [SeksiPelayananController::class, 'addPelayanan'])->name('addPelayanan');

        Route::get('get-pelayanan/{id}', [SeksiPelayananController::class, 'getPelayanan']);

        Route::post('edit-pelayanan', [SeksiPelayananController::class, 'editPelayanan'])->name('editPelayanan');
        //end seksi pelayanan

        //hak
        Route::get('hak', [JenisHakController::class, 'index'])->name('hak');

        Route::get('get-data-hak', [JenisHakController::class, 'getDatahak'])->name('getDataHak');

        Route::post('add-hak', [JenisHakController::class, 'addHak'])->name('addHak');

        Route::get('get-hak/{id}', [JenisHakController::class, 'getHak']);

        Route::post('edit-hak', [JenisHakController::class, 'editHak'])->name('editHak');
        //endhak
        //user
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::get('get-data-user', [UserController::class, 'getDataUser'])->name('getDataUser');
        Route::post('user', [UserController::class, 'addUser'])->name('addUser');

        Route::get('get-user/{id}', [UserController::class, 'getUser'])->name('getUser');

        Route::post('edit-user', [UserController::class, 'editUser'])->name('editUser');
        //enduser

        //pejabat
        Route::get('penandatangan', [PejabatController::class, 'index'])->name('penandatangan');

        Route::patch('edit-penandatangan', [PejabatController::class, 'editPenandatangan'])->name('editPenandatangan');
        //end pejabat
    });


    Route::middleware('hakakses:1,2,3,5,6,7')->group(function () {
        //peminjaman
        Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman');
        Route::get('find-kelurahan/{id}', [PeminjamanController::class, 'findKelurahan']);
        Route::post('cari-peminjaman', [PeminjamanController::class, 'cariPeminjaman'])->name('cariPeminjaman');

        Route::get('get-cart', [PeminjamanController::class, 'getCart']);
        Route::get('drop-cart', [PeminjamanController::class, 'dropCart'])->name('dropCart');

        Route::post('lanjut-peminjaman', [PeminjamanController::class, 'lanjutPeminjaman'])->name('lanjutPeminjaman');

        Route::get('get-pengajuan', [PeminjamanController::class, 'getPengajuan'])->name('getPengajuan');

        Route::post('terima-kirim', [PeminjamanController::class, 'terimaKirim'])->name('terimaKirim');

        Route::post('tidak-kirim', [PeminjamanController::class, 'tidakKirim'])->name('tidakKirim');

        Route::get('get-peminjaman', [PeminjamanController::class, 'getPeminjaman'])->name('getPeminjaman');

        Route::post('kembalikan-berkas', [PeminjamanController::class, 'kembalikanBerkas'])->name('kembalikanBerkas');

        Route::get('get-selesai', [PeminjamanController::class, 'getSelesai'])->name('getSelesai');

        Route::get('cek-status-arsip/{id}', [PeminjamanController::class, 'cekStatusArsip'])->name('cekStatusArsip');

        Route::get('pengembalian', [PeminjamanController::class, 'pengembalian'])->name('pengembalian');

        Route::post('batal-pengajuan', [PeminjamanController::class, 'batalPengajuan'])->name('batalPengajuan');

        Route::post('kirim-forward', [PeminjamanController::class, 'kirimForward'])->name('kirimForward');

        Route::post('terima-forward', [PeminjamanController::class, 'terimaForward'])->name('terimaForward');

        Route::post('tidak-forward', [PeminjamanController::class, 'tidakForward'])->name('tidakForward');

        Route::get('print-data-peminjaman', [PeminjamanController::class, 'printDataPeminjaman'])->name('printDataPeminjaman');

        Route::get('get-dashboard', [PeminjamanController::class, 'getDashboard'])->name('getDashboard');

        Route::get('get-count-peminjaman', [PeminjamanController::class, 'getCountPeminjaman'])->name('getCountPeminjaman');

        Route::get('watermark/{peminjaman_id}', [PeminjamanController::class, 'watermark'])->name('watermark');

        Route::post('upload-arsip', [PeminjamanController::class, 'uploadArsip'])->name('uploadArsip');

        Route::get('hapus-watermark/{id_peminjaman}', [PeminjamanController::class, 'hapusWatermark'])->name('hapusWatermark');

        Route::get('printListPengembalian', [PeminjamanController::class, 'printListPengembalian'])->name('printListPengembalian');
        //endpeminjaman
    });

    //arsip
    Route::get('get-dashboard-global', [HomeController::class, 'getDashboardGlobal'])->name('getDashboardGlobal');

    Route::get('get-list-pengajuan', [HomeController::class, 'getListPengajuan'])->name('getListPengajuan');

    Route::get('print-pengajuan', [HomeController::class, 'printPengajuan'])->name('printPengajuan');

    Route::get('printListPengajuan', [HomeController::class, 'printListPengajuan'])->name('printListPengajuan');

    Route::get('input-pengajuan', [HomeController::class, 'inputPengajuan'])->name('inputPengajuan');

    Route::post('terima-pengajuan', [HomeController::class, 'terimaPengajuan'])->name('terimaPengajuan');

    Route::get('get-list-peminjaman', [HomeController::class, 'getListPeminjaman'])->name('getListPeminjaman');

    Route::post('terima-pengembalian', [HomeController::class, 'terimaPengembalian'])->name('terimaPengembalian');

    Route::post('tidak-pengembalian', [HomeController::class, 'tidakPengembalian'])->name('tidakPengembalian');

    Route::get('get-list-selesai', [HomeController::class, 'getListSelesai'])->name('getListSelesai');

    Route::get('get-count', [HomeController::class, 'getCount'])->name('getCount');

    Route::get('edit-urgent/{no_tiket}', [HomeController::class, 'editUrgent'])->name('editUrgent');

    Route::get('batal-urgent/{no_tiket}', [HomeController::class, 'batalUrgent'])->name('batalUrgent');

    Route::get('print-all-pengajuan', [HomeController::class, 'printAllPengajuan'])->name('printAllPengajuan');

    Route::post('export-selesai', [HomeController::class, 'exportSelesaiExcel'])->name('exportSelesaiExcel');

    Route::get('get-list-dikirim', [HomeController::class, 'getListDikirim'])->name('getListDikirim');

    Route::get('get-list-forward', [HomeController::class, 'getListForward'])->name('getListForward');

    Route::get('get-ist-pengembalian', [HomeController::class, 'getListPengembalian'])->name('getListPengembalian');

    Route::get('getListPengajuanTable', [HomeController::class, 'getListPengajuanTable'])->name('getListPengajuanTable');
    Route::get('printGetListPengajuan', [HomeController::class, 'printGetListPengajuan'])->name('printGetListPengajuan');
    //endarsip

    Route::middleware('hakakses:1,2,3,5,6,7')->group(function () {
        //ba st
        Route::get('get-st', [BaSt::class, 'getSt'])->name('getSt');
        Route::get('st', [BaSt::class, 'St'])->name('St');

        Route::get('print-st', [BaSt::class, 'printSt'])->name('printSt');

        Route::get('print-st-sp', [BaSt::class, 'printStSp'])->name('printStSp');

        Route::get('pdf-st', [BaSt::class, 'pdfSt'])->name('pdfSt');

        Route::get('pdf-st-sp', [BaSt::class, 'pdfStSp'])->name('pdfStSp');

        Route::get('print-ba', [BaSt::class, 'printBa'])->name('printBa');

        Route::get('pdf-ba', [BaSt::class, 'pdfBa'])->name('pdfBa');

        Route::get('pdf-ba-sp', [BaSt::class, 'pdfBaSp'])->name('pdfBaSp');

        Route::get('print-ba-sp', [BaSt::class, 'printBaSp'])->name('printBaSp');

        Route::get('get-dt-peminjaman', [BaSt::class, 'getDtPeminjaman']);

        Route::post('edit-pdf-st', [BaSt::class, 'editPdfSt'])->name('editPdfSt');
        Route::post('add-pdf-st', [BaSt::class, 'addPdfSt'])->name('addPdfSt');

        Route::get('get-ba', [BaSt::class, 'getBa'])->name('getBa');
        Route::get('ba', [BaSt::class, 'Ba'])->name('Ba');

        Route::post('edit-pdf-ba', [BaSt::class, 'editPdfBa'])->name('editPdfBa');
        Route::post('add-pdf-ba', [BaSt::class, 'addPdfBa'])->name('addPdfBa');

        Route::get('ba-pps', [BaSt::class, 'baPps'])->name('baPps');
        Route::get('get-ba-pps', [BaSt::class, 'getBaPps'])->name('getBaPps');

        Route::get('pdf-st-sp-php', [BaSt::class, 'pdfStSpPhp'])->name('pdfStSpPhp');

        Route::get('pdf-ba-sp-php', [BaSt::class, 'pdfBaSpPhp'])->name('pdfBaSpPhp');

        Route::get('get-dt-ba', [BaSt::class, 'getDtBa'])->name('getDtBa');
        Route::post('add-pdf-ba-bt', [BaSt::class, 'addPdfBaBt'])->name('addPdfBaBt');
        Route::post('edi-pdt-ba-bt', [BaSt::class, 'editPdfBaBt'])->name('editPdfBaBt');

        Route::post('add-pdf-ba-su', [BaSt::class, 'addPdfBaSu'])->name('addPdfBaSu');
        Route::post('edi-pdt-ba-su', [BaSt::class, 'editPdfBaSu'])->name('editPdfBaSu');
        //end ba st

        Route::get('/delete-cart/{id}', [PeminjamanController::class, 'deleteCart'])->name('deleteCart');
    });


    //history
    Route::get('get-history/{id}', [PeminjamanController::class, 'getHistory'])->name('getHistory');


    //block
    Route::get('forbidden-access', [AuthController::class, 'block'])->name('block');
    //endblock

    Route::get('ganti-password', [UserController::class, 'gantiPassword'])->name('gantiPassword');

    Route::post('edit-password', [UserController::class, 'editPassword'])->name('editPassword');
});


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login_page'])->name('loginPage');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
