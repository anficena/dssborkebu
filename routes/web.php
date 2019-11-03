<?php

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
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/soc_guest','GuestController@soc')->name('soc_guest');
Route::get('soc/data/tahun', 'SocController@getTahun')->name('soc.tahun');
Route::get('soc/data/chart/{start}/{akhir}', 'SocController@chart')->name('Soc.chart');
Route::get('soc/data/map/{start}', 'SocController@dataTahunan')->name('Soc.tahunan');
Route::get('soc/detail/{soc}', 'SocController@show')->name('soc.show');
Route::get('soc/data/table', 'SocController@dataTableSoc')->name('soc.table');


Route::get('/kajian_guest','GuestController@kajian')->name('kajian_guest');
Route::get('kajian/data/tahun', 'KajianController@getKategori')->name('kajian.tahun');
Route::get('kajian/data/chart/{start}/{end}', 'KajianController@chart')->name('kajian.chart');
Route::get('kajian/data/table', 'KajianController@dataTableKajian')->name('kajian.table');
Route::get('kajian/data/table/publikasi', 'KajianController@dataTablePublikasi')->name('kajian.table.publikasi');
Route::get('kajian/search/publikasi/{params}', 'KajianController@searchPublikasi')->name('kajian.search.publikasi');

Route::get('kajian/filter/{kajian}', 'KajianController@filter')->name('kajian.filter');
Route::get('kajian/show/{tahun}/{kategori}', 'KajianController@showCount')->name('kajian.show.count');
Route::get('kajian/{kajian}', 'KajianController@show')->name('kajian.show');

Route::get('/dokumentasi_guest','GuestController@dokumentasi')->name('dokumentasi_guest');
Route::get('dokumentasi/kategori/{dok}', 'DokumentasiController@kategori')->name('dokumentasi.kategori');
Route::get('dokumentasi/detail/{dok}', 'DokumentasiController@show')->name('dokumentasi.show');
Route::get('pameran/data/{tahun}', 'PameranController@dataTahunan')->name('pameran.tahunan');
// Route::get('dokumentasi/data/table', 'PelayananController@dataTablePelayanan')->name('pelayanan.table');

Route::get('/kemitraan_guest','GuestController@kemitraan')->name('kemitraan_guest');
Route::get('kemitraan/kategori/{kemitraan}', 'KemitraanController@getKemitraan')->name('kemitraan.kategori');
Route::get('kemitraan/data/table', 'KemitraanController@dataTableKemitraan')->name('kemitraan.table');
Route::get('layanankpk/data/table/{param}', 'LayananKpkController@dataTableLayananKpk')->name('layanankpk.table');
Route::get('layanan_temuan/data/table', 'LayananTemuanController@dataTableLayananTemuan')->name('layanan_temuan.table');
Route::get('layanan_aduan/data/table', 'LayananAduanController@dataTableLayananAduan')->name('layanan_aduan.table');

Route::get('/perawatan_guest','GuestController@perawatan')->name('perawatan_guest');
Route::get('perawatan/data/kategori', 'PerawatanController@getKategori')->name('perawatan.kategori');
Route::get('perawatan/data/tahun', 'PerawatanController@getTahun')->name('perawatan.tahun');
Route::get('perawatan/data/chart/{candi}/{params}/{tahun}', 'PerawatanController@chart')->name('perawatan.chart');
Route::get('perawatan/data/table', 'PerawatanController@dataTablePerawatan')->name('perawatan.table');

Route::get('/monev_guest','GuestController@monev')->name('monev_guest');
Route::get('monev_batu/data/kategori', 'MonevBatuController@getKategori')->name('monev_batu.kategori');
Route::get('monev_batu/data/tahun', 'MonevBatuController@getTahun')->name('monev_batu.tahun');
Route::get('monev_batu/data/chart/{start}/{akhir}/{jenis}', 'MonevBatuController@chart')->name('monev_batu.chart');

Route::get('iklim/data/kategori', 'ObservasiIklimController@getKategori')->name('iklim.kategori');
Route::get('iklim/data/tahun', 'ObservasiIklimController@getKategori')->name('iklim.tahun');
Route::get('iklim/data/chart/{kawasan}/{jenis}/{tahun}', 'ObservasiIklimController@chart')->name('iklim.chart');

Route::get('kedalaman_sumur/data/tahun', 'KedalamanSumurController@getKategori')->name('kedalaman_sumur.tahun');
Route::get('kedalaman_sumur/data/chart/{tahun}/{tahun2}', 'KedalamanSumurController@chart')->name('kedalaman_sumur.chart');

Route::get('kedalaman_resapan/data/tahun', 'SumurResapanController@getKategori')->name('kedalaman_resapan.tahun');
Route::get('kedalaman_resapan/data/chart/{t1}/{t2}', 'SumurResapanController@chart')->name('kedalaman_resapan.chart');

Route::get('tingkat_pengunjung/data/tahun', 'TingkatPengunjungController@getKategori')->name('tingkat_pengunjung.tahun');
Route::get('tingkat_pengunjung/data/chart/{candi}/{tahun}', 'TingkatPengunjungController@chart')->name('tingkat_pengunjung.chart');



// Route::get('/', 'OauthClientsController@redirect')->name('oauth.redirect');
// Route::get('/auth/callback', 'OauthClientsController@redirect')->name('oauth.callback');
Route::get('guest', function () {
	return view('dashboard');
})->name('guest');

Route::get('/settings', 'SettingController@index')->name('settings');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	
	Route::get('kawasan_page', function () {
		return view('dssmenu.kawasan');
	})->name('kawasan');
	
	// Route::get('soc_page', function () {
	// 	return view('dssmenu.soc');
	// })->name('soc');

	

	Route::get('soc_page', 'SocController@index')->name('soc');

	Route::get('monev', function () {
		return view('dssmenu.monev');
	})->name('monev');

	Route::get('perawatan_page', function () {
		return view('dssmenu.perawatan');
	})->name('perawatan');

	Route::get('kajian_page', 'KajianController@index')->name('studi');

	// Route::get('dokumentasi_page', function () {
	// 	return view('dssmenu.dokumentasi');
	// })->name('dokumentasi');
	Route::get('publikasi_page', function () {
		return view('dssmenu.publikasi');
	})->name('publikasi');

	// Route::get('pameran_page', function () {
	// 	return view('dssmenu.pameran');
	// })->name('pameran');

	Route::get('pelayanan_page', function () {
		return view('dssmenu.pelayanan');
	})->name('pelayanan');

	Route::get('kemitraan_page', function () {
		return view('dssmenu.kemitraan');
	})->name('kemitraan');

	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);

	Route::resource('kawasan', 'CandiController', ['except' => ['update']]);
	Route::post('kawasan/{soc}', 'CandiController@update')->name('kawasan.update');
	Route::get('kawasan/data/table', 'CandiController@dataTableKawasan')->name('kawasan.table');

	Route::resource('soc', 'SocController', ['except' => ['update','show']]);
	Route::post('soc/{soc}', 'SocController@update')->name('soc.update');
	

	Route::resource('monev_batu', 'MonevBatuController', ['except' => ['update']]);
	Route::post('monev_batu/{id}', 'MonevBatuController@update')->name('monev_batu.update');
	Route::get('monev_batu/data/table', 'MonevBatuController@dataTableMonevBatu')->name('monev_batu.table');

	Route::resource('titik_kontrol', 'TitikKontrolController', ['except' => ['update']]);
	Route::post('titik_kontrol/{kajian}', 'TitikKontrolController@update')->name('titik_kontrol.update');
	Route::get('titik_kontrol/data/tahun', 'TitikKontrolController@getKategori')->name('titik_kontrol.tahun');
	Route::get('titik_kontrol/data/chart/{start}/{end}', 'TitikKontrolController@chart')->name('titik_kontrol.chart');
	Route::get('titik_kontrol/data/table', 'TitikKontrolController@dataTableTitikKontrol')->name('titik_kontrol.table');
	Route::get('titik_kontrol/data/import', 'TitikKontrolController@import')->name('titik_kontrol.import');
	Route::post('titik_kontrol/data/import', 'TitikKontrolController@importStore')->name('titik_kontrol.import.store');

	Route::resource('kemiringan_dinding', 'KemiringanDindingController', ['except' => ['update']]);
	Route::post('kemiringan_dinding/{kajian}', 'KemiringanDindingController@update')->name('kemiringan_dinding.update');
	Route::get('kemiringan_dinding/data/tahun', 'KemiringanDindingController@getKategori')->name('kemiringan_dinding.tahun');
	Route::get('kemiringan_dinding/data/chart/{start}/{end}', 'KemiringanDindingController@chart')->name('kemiringan_dinding.chart');
	Route::get('kemiringan_dinding/data/table', 'KemiringanDindingController@dataTableKemiringanDinding')->name('kemiringan_dinding.table');
	Route::get('kemiringan_dinding/data/import', 'KemiringanDindingController@import')->name('kemiringan_dinding.import');
	Route::post('kemiringan_dinding/data/import', 'KemiringanDindingController@importStore')->name('kemiringan_dinding.import.store');

	Route::resource('iklim', 'ObservasiIklimController', ['except' => ['update']]);
	Route::post('iklim/{id}', 'ObservasiIklimController@update')->name('iklim.update');
	Route::get('iklim/data/table', 'ObservasiIklimController@dataTableIklim')->name('iklim.table');
	Route::get('iklim/data/import', 'ObservasiIklimController@import')->name('iklim.import');
	Route::post('iklim/data/import', 'ObservasiIklimController@importStore')->name('iklim.import.store');

	Route::resource('perawatan', 'PerawatanController', ['except' => ['update']]);
	Route::post('perawatan/{id}', 'PerawatanController@update')->name('perawatan.update');
	

	Route::resource('kajian', 'KajianController', ['except' => ['update','show']]);
	Route::post('kajian/{kajian}', 'KajianController@update')->name('kajian.update');

	Route::resource('dokumentasi', 'DokumentasiController', ['except' => ['update','show']]);
	Route::post('dokumentasi/{dok}', 'DokumentasiController@update')->name('dokumentasi.update');
	Route::get('dokumentasi/data/table', 'DokumentasiController@dataTableDokumentasi')->name('dokumentasi.table');

	Route::resource('pameran', 'PameranController', ['except' => ['update']]);
	Route::post('pameran/{dok}', 'PameranController@update')->name('pameran.update');
	Route::get('pameran/data/table', 'PameranController@dataTablePameran')->name('pameran.table');
	

	Route::resource('flora', 'DataFloraController', ['except' => ['update']]);
	Route::post('flora/{kajian}', 'DataFloraController@update')->name('flora.update');
	Route::get('flora/data/tahun', 'DataFloraController@getKategori')->name('flora.tahun');
	Route::get('flora/data/chart/{start}/{end}', 'DataFloraController@chart')->name('flora.chart');
	Route::get('flora/data/table', 'DataFloraController@dataTableFlora')->name('flora.table');

	Route::resource('fauna', 'DataFaunaController', ['except' => ['update']]);
	Route::post('fauna/{kajian}', 'DataFaunaController@update')->name('fauna.update');
	Route::get('fauna/data/tahun', 'DataFaunaController@getKategori')->name('fauna.tahun');
	Route::get('fauna/data/chart/{start}/{end}', 'DataFaunaController@chart')->name('fauna.chart');
	Route::get('fauna/data/table', 'DataFaunaController@dataTableFauna')->name('fauna.table');

	Route::resource('bak', 'BakKontrolController', ['except' => ['update']]);
	Route::post('bak/{kajian}', 'BakKontrolController@update')->name('bak.update');
	Route::get('bak/data/tahun', 'BakKontrolController@getKategori')->name('bak.tahun');
	Route::get('bak/data/chart/{start}/{end}', 'BakKontrolController@chart')->name('bak.chart');
	Route::get('bak/data/table', 'BakKontrolController@dataTableBakKontrol')->name('bak.table');

	Route::resource('sumur', 'SumurPendudukController', ['except' => ['update']]);
	Route::post('sumur/{kajian}', 'SumurPendudukController@update')->name('sumur.update');
	Route::get('sumur/data/tahun', 'SumurPendudukController@getKategori')->name('sumur.tahun');
	Route::get('sumur/data/chart/{start}/{end}', 'SumurPendudukController@chart')->name('sumur.chart');
	Route::get('sumur/data/table', 'SumurPendudukController@dataTableSumur')->name('sumur.table');

	Route::resource('udara', 'KualitasUdaraController', ['except' => ['update']]);
	Route::post('udara/{kajian}', 'KualitasUdaraController@update')->name('udara.update');
	Route::get('udara/data/tahun', 'KualitasUdaraController@getKategori')->name('udara.tahun');
	Route::get('udara/data/chart/{start}/{end}', 'KualitasUdaraController@chart')->name('udara.chart');
	Route::get('udara/data/table', 'KualitasUdaraController@dataTableUdara')->name('udara.table');

	Route::resource('kebisingan', 'KebisinganController', ['except' => ['update']]);
	Route::post('kebisingan/{kajian}', 'KebisinganController@update')->name('kebisingan.update');
	Route::get('kebisingan/data/tahun', 'KebisinganController@getKategori')->name('kebisingan.tahun');
	Route::get('kebisingan/data/chart/{start}/{end}', 'KebisinganController@chart')->name('kebisingan.chart');
	Route::get('kebisingan/data/table', 'KebisinganController@dataTableKebisingan')->name('kebisingan.table');

	Route::resource('kedalaman_sumur', 'KedalamanSumurController', ['except' => ['update']]);
	Route::post('kedalaman_sumur/{kajian}', 'KedalamanSumurController@update')->name('kedalaman_sumur.update');
	Route::get('kedalaman_sumur/data/table', 'KedalamanSumurController@dataTableKedalamanSumur')->name('kedalaman_sumur.table');
	Route::get('kedalaman_sumur/data/import', 'KedalamanSumurController@import')->name('kedalaman_sumur.import');
	Route::post('kedalaman_sumur/data/import', 'KedalamanSumurController@importStore')->name('kedalaman_sumur.import.store');

	Route::resource('kedalaman_resapan', 'SumurResapanController', ['except' => ['update']]);
	Route::post('kedalaman_resapan/{kajian}', 'SumurResapanController@update')->name('kedalaman_resapan.update');
	// Route::get('kedalaman_resapan/data/tahun', 'SumurResapanController@getKategori')->name('kedalaman_resapan.tahun');
	// Route::get('kedalaman_resapan/data/chart/{start}/{end}', 'SumurResapanController@chart')->name('kedalaman_resapan.chart');
	Route::get('kedalaman_resapan/data/table', 'SumurResapanController@dataTableKedalamanSumurResapan')->name('kedalaman_resapan.table');
	Route::get('kedalaman_resapan/data/import', 'SumurResapanController@import')->name('kedalaman_resapan.import');
	Route::post('kedalaman_resapan/data/import', 'SumurResapanController@importStore')->name('kedalaman_resapan.import.store');
	

	Route::resource('water_mater', 'WaterMaterController', ['except' => ['update']]);
	Route::post('water_mater/{kajian}', 'WaterMaterController@update')->name('water_mater.update');
	Route::get('water_mater/data/tahun', 'WaterMaterController@getKategori')->name('water_mater.tahun');
	Route::get('water_mater/data/chart/{start}/{end}', 'WaterMaterController@chart')->name('water_mater.chart');
	Route::get('water_mater/data/table', 'WaterMaterController@dataTableWaterMater')->name('water_mater.table');

	Route::resource('filter_layer', 'FilterLayerController', ['except' => ['update']]);
	Route::post('filter_layer/{kajian}', 'FilterLayerController@update')->name('filter_layer.update');
	Route::get('filter_layer/data/tahun', 'FilterLayerController@getKategori')->name('filter_layer.tahun');
	Route::get('filter_layer/data/chart/{start}/{end}', 'FilterLayerController@chart')->name('filter_layer.chart');
	Route::get('filter_layer/data/table', 'FilterLayerController@dataTableFilterLayer')->name('filter_layer.table');

	Route::resource('monev_stabilitas', 'MonevStabilitasController', ['except' => ['update']]);
	Route::post('monev_stabilitas/{kajian}', 'MonevStabilitasController@update')->name('monev_stabilitas.update');
	Route::get('monev_stabilitas/data/table', 'MonevStabilitasController@dataTableMonevStabilitas')->name('monev_stabilitas.table');

	Route::resource('monev_kawasan', 'MonevKawasanController', ['except' => ['update']]);
	Route::post('monev_kawasan/{kajian}', 'MonevKawasanController@update')->name('monev_kawasan.update');
	Route::get('monev_kawasan/data/tahun', 'MonevKawasanController@getKategori')->name('monev_kawasan.tahun');
	Route::get('monev_kawasan/data/chart/{start}/{end}', 'MonevKawasanController@chart')->name('monev_kawasan.chart');
	Route::get('monev_kawasan/data/table', 'MonevKawasanController@dataTableMonevKawasan')->name('monev_kawasan.table');

	Route::resource('monev_lingkungan', 'MonevLingkunganController', ['except' => ['update']]);
	Route::post('monev_lingkungan/{kajian}', 'MonevLingkunganController@update')->name('monev_lingkungan.update');
	Route::get('monev_lingkungan/data/tahun', 'MonevLingkunganController@getKategori')->name('monev_lingkungan.tahun');
	Route::get('monev_lingkungan/data/chart/{start}/{end}', 'MonevLingkunganController@chart')->name('monev_lingkungan.chart');
	Route::get('monev_lingkungan/data/table', 'MonevLingkunganController@dataTableMonevLingkungan')->name('monev_lingkungan.table');

	Route::resource('monev_geohidrologi', 'MonevGeohidrologiController', ['except' => ['update']]);
	Route::post('monev_geohidrologi/{kajian}', 'MonevGeohidrologiController@update')->name('monev_geohidrologi.update');
	Route::get('monev_geohidrologi/data/tahun', 'MonevGeohidrologiController@getKategori')->name('monev_geohidrologi.tahun');
	Route::get('monev_geohidrologi/data/chart/{start}/{end}', 'MonevGeohidrologiController@chart')->name('monev_geohidrologi.chart');
	Route::get('monev_geohidrologi/data/table', 'MonevGeohidrologiController@dataTableMonevGeohidrologi')->name('monev_geohidrologi.table');

	Route::resource('monev_pemanfaatan', 'MonevPemanfaatanController', ['except' => ['update']]);
	Route::post('monev_pemanfaatan/{kajian}', 'MonevPemanfaatanController@update')->name('monev_pemanfaatan.update');
	Route::get('monev_pemanfaatan/data/tahun', 'MonevPemanfaatanController@getKategori')->name('monev_pemanfaatan.tahun');
	Route::get('monev_pemanfaatan/data/chart/{start}/{end}', 'MonevPemanfaatanController@chart')->name('monev_pemanfaatan.chart');
	Route::get('monev_pemanfaatan/data/table', 'MonevPemanfaatanController@dataTableMonevPemanfaatan')->name('monev_pemanfaatan.table');

	Route::resource('tingkat_pengunjung', 'TingkatPengunjungController', ['except' => ['update']]);
	Route::post('tingkat_pengunjung/{kajian}', 'TingkatPengunjungController@update')->name('tingkat_pengunjung.update');
	Route::get('tingkat_pengunjung/data/table', 'TingkatPengunjungController@dataTablePengunjung')->name('tingkat_pengunjung.table');

	Route::resource('pelayanan', 'PelayananController', ['except' => ['update']]);
	Route::post('pelayanan/{pelayanan}', 'PelayananController@update')->name('pelayanan.update');


	Route::resource('kemitraan', 'KemitraanController', ['except' => ['update']]);
	Route::post('kemitraan/{kemitraan}', 'KemitraanController@update')->name('kemitraan.update');
	

	Route::resource('layanan_temuan', 'LayananTemuanController', ['except' => ['update']]);
	Route::post('layanan_temuan/{kemitraan}', 'LayananTemuanController@update')->name('layanan_temuan.update');
	

	Route::resource('layanan_aduan', 'LayananAduanController', ['except' => ['update']]);
	Route::post('layanan_aduan/{kemitraan}', 'LayananAduanController@update')->name('layanan_aduan.update');
	

	Route::resource('layanankpk', 'LayananKpkController',['except' => ['update', 'create']]);
	Route::get('layanankpk/create/{kemitraan}', 'LayananKpkController@create')->name('layanankpk.create');
	Route::post('layanankpk/{kemitraan}', 'LayananKpkController@update')->name('layanankpk.update');
	
	
	Route::resource('mow', 'MowController', ['except' => ['update']]);
	Route::post('mow/{mow}', 'MowController@update')->name('mow.update');
	Route::get('mow/data/table', 'MowController@dataTableMow')->name('mow.table');

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});