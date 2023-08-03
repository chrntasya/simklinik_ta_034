<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\rujukanController;


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

Route::get('/', function () {
    return redirect()->route('home');
});

// Route::post('/create_user', [App\Http\Controllers\AuthController::class, 'register'])->name('create_user');
Route::post('/user_pasien/register', [App\Http\Controllers\PasienController::class, 'register'])->name('user_pasien.register');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth'], "prefix" => "/admin"], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/obat/cekobat', [App\Http\Controllers\ObatController::class, 'cekObat'])->name('obat.cekobat');
    Route::resource('obat', App\Http\Controllers\ObatController::class);
    
    Route::resource('pembelian_obat_suppliers', App\Http\Controllers\PembelianObatSuppliersController::class);
    Route::resource('resep_obat', App\Http\Controllers\ResepObatController::class);
    Route::post('/resepObat/deleteObat', [App\Http\Controllers\ResepObatController::class, 'deleteObat'])->name('resepobat.deleteobat');

    Route::resource('resep_obat_detail', App\Http\Controllers\ResepObatDetailController::class);
    Route::resource('kategori_obat', App\Http\Controllers\KategoriObatController::class);
    Route::resource('tempat_rujukan', App\Http\Controllers\TempatRujukanController::class);
    Route::resource('user_admin', App\Http\Controllers\AdminController::class);
    Route::resource('user_dokter', App\Http\Controllers\DokterController::class);    
    Route::resource('user_pasien', App\Http\Controllers\PasienController::class);   
    Route::resource('user_apoteker', App\Http\Controllers\ApotekerController::class);
    Route::resource('spesialis', App\Http\Controllers\SpesialisController::class);

    Route::get('jadwal_dokter', [App\Http\Controllers\DokterHomeController::class, 'jadwal_dokter' ])->name('jadwal_dokter');
    Route::get('form_jadwal_dokter', [App\Http\Controllers\DokterHomeController::class, 'form_jadwal_dokter' ])->name('form_jadwal_dokter');
    Route::post('buat_jadwal_dokter', [App\Http\Controllers\DokterHomeController::class, 'buat_jadwal_dokter' ])->name('buat_jadwal_dokter');
    Route::delete('delete_jadwal_dokter/{id}', [App\Http\Controllers\DokterHomeController::class, 'delete_jadwal_dokter' ])->name('delete_jadwal_dokter');
    Route::get('/update-status-pendaftaran/{id}', [App\Http\Controllers\LayananController::class, 'update_status_pendaftaran' ]);
    Route::resource('rujukan', App\Http\Controllers\rujukanController::class);
    Route::resource('reschedule', App\Http\Controllers\RescheduleController::class);
    Route::get('/reschedule/{id}', [App\Http\Controllers\RescheduleController::class, 'index' ]);

    Route::post('/admin_reschedule/{id}', [App\Http\Controllers\RescheduleController::class,'admin_reschedule'])->name('admin.reqreschedule');
    // Route::resource('transaksi', App\Http\Controllers\TransaksiController::class);

    //============================================================== JADWAL TELEMEDICINE =====================================================================
    Route::get('jadwaltelemedicine', [App\Http\Controllers\JadwalTelemedicineController::class, 'index' ])->name('dokter.jadwaltelemedicine');
    Route::get('jadwaltelemedicine/create', [App\Http\Controllers\JadwalTelemedicineController::class, 'create' ])->name('dokter.jadwaltelemedicine.create');
    Route::post('jadwaltelemedicine/store', [App\Http\Controllers\JadwalTelemedicineController::class, 'store' ])->name('dokter.jadwaltelemedicine.store');
    Route::post('jadwaltelemedicine/delete', [App\Http\Controllers\JadwalTelemedicineController::class, 'delete' ])->name('dokter.jadwaltelemedicine.delete');


    // ========================================================== ADMIN TRANSAKSI TELEMEDICINE ==============================================================
    Route::get('admintransaksitelemedicine', [App\Http\Controllers\AdminTransaksiTelemedicineController::class, 'index' ])->name('admin.admintransaksitelemedicine.index');
    Route::post('admintransaksitelemedicine/update', [App\Http\Controllers\AdminTransaksiTelemedicineController::class, 'updateStatus' ])->name('admin.admintransaksitelemedicine.update');


    // ========================================================= ADMIN RESEP TELEMEDICINE ===================================================================
    Route::get('reseptelemedicine', [App\Http\Controllers\AdminTransaksiTelemedicineController::class, 'indexResep' ])->name('admin.reseptelemedicine.index');
    Route::post('reseptelemedicine/penerimaan', [App\Http\Controllers\AdminTransaksiTelemedicineController::class, 'penerimaan' ])->name('admin.reseptelemedicine.penerimaan');


});

Route::group(['middleware' => ['auth'], "prefix" => "/pasien"], function(){
    Route::get('/dashboard', [App\Http\Controllers\PasienHomeController::class, 'index'])->name('pasien_home');
    Route::get('/berobat', [App\Http\Controllers\LayananController::class, 'berobat'])->name('berobat');
    Route::get('/berobat/{id}/print', [App\Http\Controllers\LayananController::class, 'print'])->name('berobat.print');


    Route::post('/berobat/daftar', [App\Http\Controllers\LayananController::class, 'pilihDokter'])->name('pasien.pilihdokter');
    Route::post('/pasien_mendaftar', [App\Http\Controllers\LayananController::class, 'pasien_mendaftar'])->name('pasien.daftar');
    Route::post('/pasien_mendaftar/cancel', [App\Http\Controllers\LayananController::class, 'cancel'])->name('pasien.cancel');

    // ================================ TELEMEDICINE ==================================
    Route::get('/telemedicine', [App\Http\Controllers\TransaksiTelemedicineController::class, 'index'])->name('pasien.telemedicine.index');
    Route::post('/telemedicine/listdokter', [App\Http\Controllers\TransaksiTelemedicineController::class, 'listDokter'])->name('pasien.telemedicine.listdokter');
    Route::post('/telemedicine/daftartelemedicine', [App\Http\Controllers\TransaksiTelemedicineController::class, 'daftarTelemedicine'])->name('pasien.telemedicine.daftar');
    Route::post('/telemedicine/transaksitelemedicine', [App\Http\Controllers\TransaksiTelemedicineController::class, 'transaksiTelemedicine'])->name('pasien.telemedicine.transaksi');


    // =============================== TRANSACTION TELEMEDICINE ======================================================
    Route::get('/transactiontelemedicine', [App\Http\Controllers\TransaksiTelemedicineController::class, 'transactionTelemedicine'])->name('pasien.transactiontelemedicine.index');
    Route::post('/transactiontelemedicine/upload', [App\Http\Controllers\TransaksiTelemedicineController::class, 'uploadBuktiPembayaran'])->name('pasien.transactiontelemedicine.upload');
    Route::post('/transactiontelemedicine/delete', [App\Http\Controllers\TransaksiTelemedicineController::class, 'deleteBukti'])->name('pasien.transactiontelemedicine.delete');
    Route::post('/transactiontelemedicine/deletetransaksi', [App\Http\Controllers\TransaksiTelemedicineController::class, 'deleteTransaksi'])->name('pasien.transactiontelemedicine.deletetransaksi');


    // ============================== FITUR CHAT PASIEN =============================================================================
    Route::get('/chat/{id}', [App\Http\Controllers\ChatController::class, 'indexPasien'])->name('pasien.chat.index');
    Route::post('/chat/getchat', [App\Http\Controllers\ChatController::class, 'getChat'])->name('pasien.chat.getchat');
    Route::post('/chat/addchat', [App\Http\Controllers\ChatController::class, 'addChat'])->name('pasien.chat.addchat');


    // ================================= FITUR RESEP TELEMEDICINE PASIEN =======================================================
    Route::get('/reseptelemedicine', [App\Http\Controllers\ResepTelemedicinePasienController::class, 'index'])->name('pasien.reseptelemedicine.index');
    Route::post('/reseptelemedicine/pengantaran', [App\Http\Controllers\ResepTelemedicinePasienController::class, 'storepengantaran'])->name('pasien.reseptelemedicine.pengantaran');



    
    
    
});

Route::group(['middleware' => ['auth'], "prefix" => "/dokter"], function(){
    Route::get('/dashboard', [App\Http\Controllers\DokterHomeController::class, 'index'])->name('dokter_home');
    Route::resource('rekamedis', App\Http\Controllers\RekamedisController::class);
    Route::resource('dokterrujukan', App\Http\Controllers\dokterRujukanController::class);
    Route::resource('pasien', App\Http\Controllers\AntrianPasienController::class);
    Route::post('pasien/batal/{id}', [App\Http\Controllers\AntrianPasienController::class, 'batal'])->name('pasien.batal');


    // ============================== TRANSAKSI TELEMEDICINE ===========================================
    Route::get('/transactiontelemedicine', [App\Http\Controllers\TransaksiTelemedicineController::class, 'transactionTelemedicinedokter'])->name('dokter.transactiontelemedicine.index');

    // =================================== CHAT =====================================================================
    Route::get('/chat/{id}', [App\Http\Controllers\ChatController::class, 'indexDokter'])->name('dokter.chat.index');

    // ================================== RESEP TELEMEDICINE========================================================
    Route::get('/resepobattelemedicine', [App\Http\Controllers\DokterResepObatTelemedicineController::class, 'index'])->name('dokter.resepobattelemedicine.index');
    Route::get('/resepobattelemedicine/{id}/create', [App\Http\Controllers\DokterResepObatTelemedicineController::class, 'create'])->name('dokter.reseptelemedicine.create');
    Route::post('/resepobattelemedicine/store', [App\Http\Controllers\DokterResepObatTelemedicineController::class, 'store'])->name('dokter.reseptelemedicine.store');
    Route::get('/resepobattelemedicine/{id}/print', [App\Http\Controllers\DokterResepObatTelemedicineController::class, 'print'])->name('dokter.reseptelemedicine.print');

    

});

Route::group(['middleware' => ['auth'], "prefix" => "/apoteker"], function(){
    Route::get('/dashboard', [App\Http\Controllers\ApotekerHomeController::class, 'index'])->name('apoteker_home');
    // Route::resource('rekamedis', App\Http\Controllers\RekamedisController::class);
    // Route::resource('dokterrujukan', App\Http\Controllers\dokterRujukanController::class);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class);
    Route::get('/transaksi/{transaksi}', [App\Http\Controllers\TransaksiController::class,'createTransaksi'])->name('transaksi.createTransaksi');
    Route::get('listrekammedis', [App\Http\Controllers\TransaksiController::class,'listrekammedis'])->name('transaksi.listrekammedis');
    Route::get('/transaksi/{transaksi}/invoice', [App\Http\Controllers\TransaksiController::class,'print'])->name('transaksi.invoice');

    
    Route::post('resepobatbaru', [App\Http\Controllers\ResepObatController::class,'storebaru'])->name('resepobat.storebaru');
    Route::get('resepobatbaru/{rekammedis}/download', [App\Http\Controllers\ResepObatController::class,'download'])->name('resepbaru.download');


    // ============================================================ notifikasi ==============================================================
    Route::post('notifikasi', [App\Http\Controllers\HomeController::class,'notification'])->name('apoteker.notifikasi');
    Route::get('deletenotifikasi', [App\Http\Controllers\HomeController::class,'deletenotification'])->name('apoteker.deletenotifikasi');


});
