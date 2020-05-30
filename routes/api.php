<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('tambahagenda','AgendaController@tambahagenda');
Route::get('lihatagenda','AgendaController@lihatagenda');
Route::put('updateagenda/{id}','AgendaController@UpdateAgenda');
Route::delete('hapusagenda/{id}','AgendaController@HapusAgenda');

Route::post('tambahkonten','KontenAnimasiController@tambahkonten');
Route::get('lihatkonten','KontenAnimasiController@lihatkonten');
Route::get('showpoin/{id}', 'PoinController@show');
Route::put('updatekonten/{id}','KontenAnimasiController@UpdateKonten');
Route::delete('hapuskonten/{id}','KontenAnimasiController@HapusKonten');

Route::post('tambahpoin','PoinController@TambahPoin');
Route::get('lihatpoin','PoinController@LihatPoin');
Route::put('updatepoin/{id}','PoinController@UpdatePoin');
Route::get('showpoin/{id}','PoinController@show');

Route::post('tambahfeedback','FeedbackController@tambahfeedback');
Route::get('lihatfeedback','FeedbackController@lihatfeedback');

Route::post('Daftar','UserController@DaftarPengguna');
Route::post('Masuk','UserController@MasukPengguna');


Route::post('tambahhadiah','HadiahController@TambahHadiah');
Route::get('lihathadiah','HadiahController@LihatHadiah');
Route::put('updatehadiah/{id}','HadiahController@UpdateHadiah');
Route::delete('hapushadiah/{id}','HadiahController@HapusHadiah');

Route::get('monitoring', 'MonitoringSampahController@MonitoringSampah');
Route::get('notifsampah', 'MonitoringSampahController@NotifikasiSampah');
Route::get('n', 'Controller@__construct');
Route::get('notif', 'MonitoringSampahController@PushNotifSampah');

Route::get('masyarakat', 'MasyarakatController@Masyarakat');
Route::post('tambahmasyarakat', 'MasyarakatController@TambahMasyarakat');
Route::put('up/{id}', 'MasyarakatController@up');
Route::put('edit/{id}', 'MasyarakatController@edit');
Route::get('show/{id}', 'MasyarakatController@show');

Route::get('pimpinan', 'PimpinanController@Pimpinan');
Route::post('tpimpinan', 'PimpinanController@TambahPimpinan');

Route::get('petugaslapangan', 'PetugasLapanganController@PetugasLapangan');
Route::post('tpetugaslapangan', 'PetugasLapanganController@TambahPetugasLapangan');

Route::get('petugaskontenreward', 'PetugasKontenRewardController@PetugasKontenReward');
Route::post('tpetugaskontenreward', 'PetugasKontenRewardController@TambahPetugasKontenReward');

Route::get('showt/{id}','TransaksiController@show');
Route::put('transaksi/{id}','TransaksiController@transaksi');
Route::get('lihattransaksi/{id}','TransaksiController@LihatTransaksi');
Route::post('t','TransaksiController@tambah');