<?php
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Auth;
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
    return view('home.index');
});

Route::get('/private/developer/pass/{id}', function($id){
    $first = $id - 100;
    $last = $id;

    $data = App\User::where('id', '>=', $first)
    ->where('id','<=',$last)
	->get();
	foreach($data as $row){
		App\User::find($row->id)->update([
			'password' => $row->nim
		]);
	}
	return 1;
});

//Login User
Route::get('/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout')->name('logout');

//Login Admin
Route::get('/admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminAuthController@postLogin');
Route::get('/admin/logout', 'Auth\AdminAuthController@getLogout')->name('admin.logout');


// Route::get('/edit', function () {
//     return view('admin.edit-mahasiswa');
// });

// Admin
Route::resource('/admin', 'AdminController');
Route::get('/admin-mahasiswa', 'AdminController@mahasiswaIndex')->name('admin.mahasiswa');
Route::get('/admin-mahasiswa/create', 'AdminController@mahasiswaCreate')->name('admin.mahasiswa-create');
Route::get('/admin-mahasiswa/{id}/edit', 'AdminController@mahasiswaEdit')->name('admin.mahasiswa-edit');
Route::post('/admin-mahasiswa', 'AdminController@mahasiswaStore')->name('admin.mahasiswa-store');
Route::put('/admin-mahasiswa/{id}', 'AdminController@mahasiswaUpdate')->name('admin.mahasiswa-update');
Route::get('/admin-mahasiswa/{id}/verify', 'AdminController@verify')->name('admin.mahasiswa-verify');
Route::get('/admin-mahasiswa/{id}/download/surat-sakit', 'AdminController@getpdfscan')->name('admin.mahasiswa-surat-sakit');
Route::get('/admin-mahasiswa/{id}/download/bukti-pembayaran', 'AdminController@getBuktiPembayaran')->name('admin.mahasiswa-bukti-pembayaran');
Route::get('/admin-mahasiswa/{id}/registered', 'AdminController@registered')->name('admin.mahasiswa-registered');
Route::post('/admin-mahasiswa/{id}/note-register', 'AdminController@noteRegister')->name('admin.mahasiswa-note-register');
Route::post('/admin-mahasiswa/{id}/note-verifikasi', 'AdminController@noteVerifikasi')->name('admin.mahasiswa-note-verifikasi');
Route::get('/admin-mahasiswa/{id}/note-download', 'AdminController@penugasanPdf')->name('admin.mahasiswa-note-download');
Route::delete('/admin-mahasiswa/{id}', 'AdminController@mahasiswaDestroy')->name('admin.mahasiswa-delete');
Route::get('/admin-sd-pengumuman', 'AdminController@sdPengumumanIndex')->name('admin.sd-pengumuman');
Route::get('/admin-sd-pengumuman/create', 'AdminController@sdPengumumanCreate')->name('admin.sd-pengumuman-create');
Route::get('/admin-sd-pengumuman/{id}/edit', 'AdminController@sdPengumumanEdit')->name('admin.sd-pengumuman-edit');
Route::post('/admin-sd-pengumuman/store', 'AdminController@sdPengumumanStore')->name('admin.sd-pengumuman-store');
Route::put('/admin-sd-pengumuman/{id}', 'AdminController@sdPengumumanUpdate')->name('admin.sd-pengumuman-update');
Route::delete('/admin-sd-pengumuman/{id}', 'AdminController@sdPengumumanDestroy')->name('admin.sd-pengumuman-destroy');
Route::get('/admin-mahasiswa-angkatan', 'AdminController@angkatanIndex')->name('admin.angkatan-index');
Route::post('/admin-mahasiswa-angkatan', 'AdminController@angkatanStore')->name('admin.angkatan-store');
Route::put('/admin-mahasiswa-angkatan/{id}', 'AdminController@angkatanUpdate')->name('admin.angkatan-update');
Route::delete('/admin-mahasiswa-angkatan/{id}', 'AdminController@angkatanDestroy')->name('admin.angkatan-destroy');
Route::get('/admin-golongan-darah', 'AdminController@golonganDarahIndex')->name('admin.golongan-darah-index');
Route::get('/admin-jenis-kelamin', 'AdminController@jenisKelaminIndex')->name('admin.jenis-kelamin-index');
Route::post('/admin-jenis-kelamin', 'AdminController@jenisKelaminStore')->name('admin.jenis-kelamin-store');
Route::put('/admin-jenis-kelamin/{id}', 'AdminController@jenisKelaminUpdate')->name('admin.jenis-kelamin-update');
Route::delete('/admin-jenis-kelamin/{id}', 'AdminController@jenisKelaminDestroy')->name('admin.jenis-kelamin-destroy');
Route::get('/admin-program-studi', 'AdminController@programStudiIndex')->name('admin.program-studi-index');
Route::post('/admin-program-studi', 'AdminController@programStudiStore')->name('admin.program-studi-store');
Route::put('/admin-program-studi/{id}', 'AdminController@programStudiUpdate')->name('admin.program-studi-update');
Route::delete('/admin-program-studi/{id}', 'AdminController@programStudiDestroy')->name('admin.program-studi-destroy');
Route::get('/export-excel', 'AdminController@exportExcel');
Route::get('/export-excel-verif', 'AdminController@exportExcelverif');
Route::resource('/log', 'LogController');
Route::resource('/note', 'NotesController');
Route::get('/penugasan-download/{id}', 'PenugasanController@getPdf')->name('penugasan.download');
Route::get('/penugasan/setting', 'PenugasanController@setting')->name('penugasan.setting');
Route::get('/penugasan/setting/add', 'PenugasanController@settingAdd')->name('penugasan.setting-add');
Route::post('/penugasan/setting/add/post', 'PenugasanController@settingPost')->name('penugasan.setting-post');
Route::get('/penugasan/setting/delete/{id}', 'PenugasanController@settingDelete')->name('penugasan.seting-delete');
Route::get('/penugasan/setting/download/{id}', 'PenugasanController@settingDownload')->name('penugasan.seting-download');
Route::resource('/penugasan', 'PenugasanController');
Route::get('/note-mahasiswa','AdminController@noteIndex')->name('admin.note-mahasiswa');
Route::resource('/prestasis', 'PrestasiController');
Route::resource('/organisasi', 'OrganisasiController');
Route::get('/prestasis-download/{id}', 'PrestasiController@getPdf')->name('prestasi.download');
Route::get('/admin-resume', 'AdminController@resumeIndex')->name('admin.resume-index');
Route::get('/admin-resume-setting', 'AdminController@resumeSetting')->name('admin.resume-setting');
Route::get('/admin-resume-setting/create', 'AdminController@resumeCreate')->name('admin.resume-setting-create');
Route::post('/admin-resume-setting/post', 'AdminController@resumePost')->name('admin.resume-setting-post');
Route::get('/admin-resume-setting/delete/{id}', 'AdminController@resumeDelete')->name('admin.resume-setting-delete');
Route::get('/admin-get/krm/{id}', 'AdminController@getKrmPdf')->name('admin-get-krm');
Route::get('/admin-get/prestasi/{id}', 'AdminController@getPrestasiPdf')->name('admin-get-prestasi');
Route::get('/admin-iklan-setting', 'IklanController@index')->name('admin-iklan');
Route::get('/admin-iklan-setting/create', 'IklanController@create')->name('admin-iklan-create');
Route::post('/admin-iklan-setting/post', 'IklanController@store')->name('admin-iklan-post');
Route::get('/admin-iklan-setting/destroy/{id}', 'IklanController@destroy')->name('admin-iklan-destroy');
Route::get('/cekemail', function(){
    $data = User::find(2727);

    return view('emails.verify')->with(['user' => $data]);
});
// End Admin

// Admin Auth
// Route::get('/login/admin', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
// Route::post('/admin/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
// Route::post('/admin/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
Route::get('/admin-password/reset', 'AdminController@gantiPasswordIndex')->name('admin.password-reset-form');
Route::post('/admin-password/reset', 'AdminController@gantiPassword')->name('admin.password-reset');
Route::get('/coba', 'AdminController@buatPassword');
Route::get('/passwordkey','PasswordController@test');

// Student Day
Route::resource('sd', 'StudentDayController');
Route::get('/sd-pengumuman', 'StudentDayController@pengumumanIndex')->name('sd-pengumuman.index');
Route::get('/sd-pengumuman/{id}', 'StudentDayController@pengumumanShow')->name('sd-pengumuman.show');
// End Student Day

// Student Day Mahasiswa
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');
Route::resource('/beranda-sd', 'DashboardSdController');
Route::get('/beranda-sd-biodata', 'DashboardSdController@biodata')->name('beranda-sd.biodata');
Route::get('/beranda-sd-cetak-berkas', 'DashboardSdController@cetakBerkas')->name('beranda-sd.cetak-berkas');
Route::get('/beranda-sd-name-tag-pdf', 'DashboardSdController@nameTag')->name('beranda-sd.name-tag');
Route::get('/beranda-sd-biodata-pdf', 'DashboardSdController@biodataPdf')->name('beranda-sd.biodata-pdf');
Route::get('/beranda-sd-evaluasi-pdf', 'DashboardSdController@evaluasiPdf')->name('beranda-sd.evaluasi-pdf');
Route::get('/beranda-sd-verifikasi', 'DashboardSdController@verifikasi')->name('beranda-sd.verifikasi');
Route::post('/beranda-sd-verifikasi/{id}', 'DashboardSdController@verifikasipost')->name('beranda-sd.verifikasi-post');
Route::get('/buku-panduan', 'DashboardSdController@panduanPdf');
Route::get('/cover-buku-panduan', 'DashboardSdController@coverpanduanPdf');
Route::get('/ganti-password', 'PasswordController@gantiPasswordForm');
Route::post('/ganti-password', 'PasswordController@gantiPassword');
Route::get('/beranda-sd-verifikasi-scan-download/{id}', 'DashboardSdController@getpdfscan');
Route::get('/beranda-sd-verifikasi-scan-download/pembayaran/{id}', 'DashboardSdController@getBuktiPembayaran');
Route::get('/beranda-sd-verifikasi-download/ketentuan', 'DashboardSdController@getKetentuanVerifikasi')->name('beranda-sd.download-ketentuan');
Route::post('/beranda-sd-verifikasi/penugasan/{id}/registrasi', 'DashboardSdController@penugasanPost')->name('post-penugasan-registrasi');
Route::post('/beranda-sd-verifikasi/penugasan/{id}/verifikasi', 'DashboardSdController@penugasanVerifikasiPost')->name('post-penugasan-verifikasi');
Route::get('/beranda-sd/verifikasi/penugasan/{id}', 'DashboardSdController@penugasanPdf')->name('get-penugasan');
Route::get('/beranda-sd/verifikasi/edit/{id}/youtube', 'DashboardSdController@editYoutube')->name('beranda-sd.verifikasi-youtube');
Route::post('/beranda-sd/verifikasi/edit/{id}/youtube', 'DashboardSdController@postYoutube')->name('beranda-sd.verifikasi-youtube-post');
Route::get('/beranda-sd/verifikasi/edit/{id}', 'DashboardSdController@editVerifikasi')->name('beranda-sd.edit-verifikasi');
Route::get('/beranda-sd/verifikasi/subscribe-youtube','DashboardSdController@subscribeView')->name('beranda-sd.subscribe-youtube');
Route::get('/beranda-sd/verifikasi/subscribed/{id}','DashboardSdController@subscribedRedirect');
Route::get('/beranda-sd-penugasan', 'DashboardSdController@tugas')->name('beranda-sd-penugasan');
Route::post('/beranda-sd-penugasan', 'DashboardSdController@penugasanPost');
Route::post('/beranda-sd-penugasan-soal/{id}', 'DashboardSdController@penugasanSoalPost')->name('beranda-sd-penugasan-soal');
Route::post('/beranda-sd-penugasan-essay/{id}', 'DashboardSdController@penugasanEssayPost')->name('beranda-sd-penugasan-essay');
Route::get('/beranda-sd-penugasan-download-soal/{id}', 'DashboardSdController@penugasanPdfDownload')->name('beranda-sd-penugasan-download-soal');
Route::get('/beranda-sd-resume', 'DashboardSdController@resume')->name('beranda-sd-resume');
Route::post('/beranda-sd-resume', 'DashboardSdController@resumePost');
Route::get('/beranda-sd-qrcode', 'DashboardSdController@qrCode')->name('beranda-sd-qrcode');
Route::get('/beranda-sd-resume/download/{id}', 'DashboardSdController@resumePdf');
Route::get('/beranda-sd-daftar/{id}', 'DashboardSdController@daftar')->name('beranda-sd-daftar');
Route::get('/beranda-sd-perbaikan/{id}', 'DashboardSdController@perbaikanBiodata')->name('beranda-sd-perbaikan');
Route::get('/get/time/resume', 'DashboardSdController@getTimeResume');
Route::get('/get/krm/{id}', 'DashboardSdController@getKrmPdf')->name('beranda-sd-get-krm');
Route::get('/beranda-sd-qrcode/link', 'DashboardSdController@qrcodelink')->name('beranda-sd-qrcode-link');
Route::get('/get/iklan/pembelianBaju', 'IklanController@getPembelianBaju');
Route::post('/add/data/pembeli', 'IklanController@addPembeli');
// End Student Day Mahasiswa

Route::get('/bkm', function () {
    return view('bkm.index');
});

Route::get('/granat', function () {
    return view('granat.index');
});

Route::get('/gallery', function () {
    return view('gallery.index');
});

// dies natalis
Route::get('/dies-natalis', 'DiesController@index')->name('dies.index');
Route::get('/download-form-kehadiran', 'DiesController@download')->name('dies.download_form');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/test', function(){
    return view('sd.identitas');
});
