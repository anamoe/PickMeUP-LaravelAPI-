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

Route::post('tambahkonten','KontenEdukasiController@tambahkonten');
Route::get('lihatkonten','KontenEdukasiController@lihatkonten');
Route::get('showpoin/{id}', 'PoinController@show');
Route::put('updatekonten/{id}','KontenEdukasiController@UpdateKonten');
Route::delete('hapuskonten/{id}','KontenEdukasiController@HapusKonten');

Route::post('tambahpoin','PoinController@TambahPoin');
Route::get('lihatpoin','PoinController@LihatPoin');
Route::put('updatepoin/{id}','PoinController@UpdatePoin');
Route::get('showpoin/{id}','PoinController@show');
Route::put('kode/{id}','PoinController@pushtukarcode');

Route::post('tambahfeedback','FeedbackController@tambahfeedback');
Route::get('lihatfeedback','FeedbackController@lihatfeedback');
Route::delete('hapusfeedback/{id}','FeedbackController@HapusFeedback');

Route::post('Daftar','UserController@DaftarPengguna');
Route::post('Masuk','UserController@MasukPengguna');


Route::post('tambahhadiah','HadiahController@TambahHadiah');
Route::get('lihathadiah','HadiahController@LihatHadiah');
Route::put('updatehadiah/{id}','HadiahController@UpdateHadiah');
Route::put('upjumlah/{id}','HadiahController@UpdateJumlahHadiah');
Route::delete('hapushadiah/{id}','HadiahController@HapusHadiah');

Route::get('monitoring', 'TempatSampahController@MonitoringSampah');
Route::get('notifsampah', 'MonitoringSampahController@NotifikasiSampah');
Route::get('n', 'Controller@__construct');
Route::post('notif', 'MonitoringSampahController@PushNotifSampah');

Route::get('masyarakat', 'MasyarakatController@Masyarakat');
Route::post('tambahmasyarakat', 'MasyarakatController@TambahMasyarakat');
Route::put('up/{id}', 'MasyarakatController@up');
Route::put('edit/{id}', 'MasyarakatController@edit');
Route::get('show/{id}', 'MasyarakatController@show');

Route::get('pimpinan', 'PimpinanController@Pimpinan');
Route::post('tpimpinan', 'PimpinanController@TambahPimpinan');
Route::get('showpimpinan/{id}', 'PimpinanController@showpimpinan');
Route::put('editdatapimpinan/{id}', 'PimpinanController@edit');


Route::get('petugaslapangan', 'PetugasLapanganController@PetugasLapangan');
Route::get('showlapangan/{id}', 'PetugasLapanganController@DataPetugasLapangan');
Route::post('tpetugaslapangan', 'PetugasLapanganController@TambahPetugasLapangan');
Route::put('editdatapl/{id}', 'PetugasLapanganController@edit');


Route::get('petugaskontenreward', 'PetugasKontenRewardController@PetugasKontenReward');
Route::post('tpetugaskontenreward', 'PetugasKontenRewardController@TambahPetugasKontenReward');
Route::get('showkonten/{id}','PetugasKontenRewardController@datapetugaskonten');
Route::put('editdatapkw/{id}', 'PetugasKontenRewardController@edit');


Route::get('showt/{id}','TransaksiController@show');
Route::put('transaksi/{id}','TransaksiController@transaksi');
Route::get('lihattransaksi/{id}','TransaksiController@LihatTransaksi');
Route::post('t','TransaksiController@tambah');