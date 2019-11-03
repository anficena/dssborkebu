@extends('layouts.app', ['activePage' => 'monev', 'titlePage' => __('Monitoring dan Evaluasi')])

@section('content')
<div class="content">
  <div class="container-fluid">
    @include('dssmenu.monev.option_monev')
    <!-- <div class="row">
      <div class="col-md-6 social-buttons-demo">
        <button class="btn btn-social btn-fill btn-facebook">
          <i class="fa fa-facebook-square"></i> Kelola Data
        </button>
        <button class="btn btn-social btn-fill btn-twitter">
          <i class="fa fa-twitter"></i> Rekapitulasi Data
        </button>
      </div>
    </div> -->
    @yield('content_monev_lingkungan')
    

    <!-- Koordinat titik kontrol -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Stabilitas Struktur dan Bukit</h4>
            <p class="card-category">Koordinat Titik Kontrol</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="tanggal">Tahun</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal">
              </div>
              <div class="form-group">
                <label for="inputState">Candi</label>
                <select id="inputState" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="koordinat">Nama Koordinat</label>
                    <input type="text" name="koordinat" class="form-control" id="koordinat">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="titik">Titik</label>
                    <input type="text" name="titik" class="form-control" id="titik">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbux">Koordinat <b>X</b></label>
                    <input type="number" name="sumbux" step="0.001" class="form-control" id="sumbux">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbuy">Koordinat <b>Y</b></label>
                    <input type="number" name="sumbuy" step="0.001" class="form-control" id="sumbuy">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbuz">Koordinat <b>Z</b></label>
                    <input type="number" name="sumbuz" step="0.001" class="form-control" id="sumbuz">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Kemiringan dinding -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Stabilitas Struktur dan Bukit</h4>
            <p class="card-category">Kemiringan Dinding</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal">
              </div>
              <div class="form-group">
                <label for="candi">Candi</label>
                <select id="candi" name="candi" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="koordinat">Nama Koordinat</label>
                    <input type="text" name="koordinat" class="form-control" id="koordinat">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="titik">Titik</label>
                    <input type="text" name="titik" class="form-control" id="titik">
                  </div>
                </div>
              </div>
              <div class="form-row">   
                <div class="form-group col-md-12">
                  <label for="arahx">Arah sumbu X</label>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbuxa">a (cm)</label>
                    <input type="number" name="sumbuxa" step="0.01" class="form-control" id="sumbuxa">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbuxb">b (cm)</label>
                    <input type="number" name="sumbuxb" step="0.01" class="form-control" id="sumbuxb">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbuxh">H (cm)</label>
                    <input type="number" name="sumbuxh" step="0.01" class="form-control" id="sumbuxh">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12"><label for="arahy">Arah sumbu Y</label></div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbuya">a (cm)</label>
                    <input type="number" name="sumbuya" step="0.01" class="form-control" id="sumbuya">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbuya">b (cm)</label>
                    <input type="number" name="sumbuya" step="0.01" class="form-control" id="sumbuya">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sumbuyh">H (cm)</label>
                    <input type="number" name="sumbuyh" step="0.01" class="form-control" id="sumbuyh">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12"><label for="kemiringan">Kemiringan</label></div>   
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kemiringan_x">X</label>
                    <input type="text" name="kemiringan_x" class="form-control" id="kemiringan_x">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kemiringan_y">Y</label>
                    <input type="text" name="kemiringan_y" class="form-control" id="kemiringan_y">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12"><label for="pedoman">Sesuai Pedoman</label></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pedoman_x">X</label>
                    <input type="text" name="pedoman_x" class="form-control" id="pedoman_x">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pedoman_y">Y</label>
                    <input type="text" name="pedoman_y" class="form-control" id="pedoman_y">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12"><label for="pedoman">Selisih Dibanding Pedoman</label></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="selisih_x">iX (Menit)</label>
                    <input type="text" name="selisih_x" class="form-control" id="selisih_x">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="selisih_y">iY (Menit)</label>
                    <input type="text" name="selisih_y" class="form-control" id="selisih_y">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" rows="5" id="keterangan">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev lingkungan -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Lingkungan</h4>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" rows="5" id="judul">
              </div>
              <div class="form-group">
                <label for="tujuan">Tujuan</label>
                <textarea name="tujuan" id="tujuan" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="sasaran">Sasaran</label>
                <textarea name="sasaran" id="sasaran" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="target">Target</label>
                <textarea name="target" id="target" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="metode">Metode</label>
                <textarea name="metode" id="metode" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-row">
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="tanggal_mulai">Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control"  id="tanggal_mulai">
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="tanggal_selesai">Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control"  id="tanggal_selesai">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="metode">Hasil</label>
                <textarea name="hasil" id="hasil" class="form-control" rows="10"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev lingkungan - Observasi Iklim -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Lingkungan</h4>
            <p class="card-category">Observasi Iklim</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="jenis_observasi">Pilih Jenis Observasi</label>
                <select name="jenis_observasi" id="jenis_pbservasi" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group">
                <label for="judul">Judul Data (Yang Diteliti)</label>
                <input type="text" name="judul" class="form-control" id="judul">
              </div>
              <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="month" name="waktu" class="form-control" id="waktu">
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hasil">Hasil</label>
                    <input type="text" name="hasil" class="form-control" id="hasil">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" class="form-control" id="satuan">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev lingkungan - Pendataan Flora -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Lingkungan</h4>
            <p class="card-category">Pendataan Flora dan Fauna</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="date" name="waktu" class="form-control" id="waktu">
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama">Nama (Flora/Fauna)</label>
                    <input type="text" name="nama" class="form-control" id="nama">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jenis">Jenis/Kategori</label>
                    <input type="text" name="jenis" class="form-control" id="jenis">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hasil">Hasil</label>
                    <input type="text" name="hasil" class="form-control" id="hasil">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" class="form-control" id="satuan">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="keterangan">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev lingkungan - Analisis Air Bak Kontrol -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Lingkungan</h4>
            <p class="card-category">Analisis Air Bak Kontrol</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="jenis">Jenis Analisis</label>
                <select class="form-control" name="jenis" id="jenis">
                  <option value="Biologi">Biologi</option>
                  <option value="Fisik">Fisik</option>
                  <option value="Kimia">Kimia</option>
                </select>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="month" name="waktu" class="form-control" id="waktu">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="lokasi">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="parameter">Parameter</label>
                    <input type="text" name="parameter" class="form-control" id="parameter">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="hasil">Hasil</label>
                    <input type="text" name="hasil" class="form-control" id="hasil">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="standar">Standar</label>
                    <input type="text" name="standar" class="form-control" id="standar">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" class="form-control" id="satuan">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev lingkungan - Analisis Air Sumur Penduduk -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Lingkungan</h4>
            <p class="card-category">Analisis Air Bak Kontrol</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="month" name="waktu" class="form-control" id="waktu">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="lokasi">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="parameter">Parameter</label>
                    <input type="text" name="parameter" class="form-control" id="parameter">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="hasil">Hasil</label>
                    <input type="text" name="hasil" class="form-control" id="hasil">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="standar">Standar</label>
                    <input type="text" name="standar" class="form-control" id="standar">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" class="form-control" id="satuan">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev lingkungan - Kebisingan -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Lingkungan</h4>
            <p class="card-category">Tingkat Kebisingan</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="month" name="waktu" class="form-control" id="waktu">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="lokasi">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hasil">Hasil</label>
                    <input type="number" name="hasil" step="0.01" class="form-control" id="hasil">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" class="form-control" id="satuan">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev lingkungan - Kebisingan -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Lingkungan</h4>
            <p class="card-category">Kualitas Udara</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="month" name="waktu" class="form-control" id="waktu">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="lokasi">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="parameter">Parameter</label>
                <input type="text" name="parameter" class="form-control" id="hasil">
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hasil">Hasil</label>
                    <input type="number" name="hasil" step="0.01" class="form-control" id="hasil">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" class="form-control" id="satuan">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev Geohidrologi -->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Geohidrologi</h4>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" rows="5" id="judul">
              </div>
              <div class="form-group">
                <label for="tujuan">Tujuan</label>
                <textarea name="tujuan" id="tujuan" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="sasaran">Sasaran</label>
                <textarea name="sasaran" id="sasaran" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="target">Target</label>
                <textarea name="target" id="target" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="metode">Metode</label>
                <textarea name="metode" id="metode" class="form-control" rows="5"></textarea>
              </div>
              <div class="form-row">
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="tanggal_mulai">Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control"  id="tanggal_mulai">
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="tanggal_selesai">Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control"  id="tanggal_selesai">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="metode">Hasil</label>
                <textarea name="hasil" id="hasil" class="form-control" rows="10"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev Geohidrologi - Kedalaman Muka Air Sumur Penduduk / Peresapan-->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Geohidrologi</h4>
            <p class="card-category">Kedalaman Muka Air Sumur Penduduk</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="month" name="waktu" class="form-control" id="waktu">
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="lokasi">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hasil">Hasil</label>
                    <input type="number" name="hasil" step="0.01" class="form-control" id="hasil">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="kondisi">Keterangan (Kondisi)</label>
                <textarea name="kondisi" class="form-control" rows="5" id="kondisi"></textarea>
              </div>
              <div class="form-group form-file-upload form-file-multiple">
                <input type="file" multiple="" class="inputFileHidden">
                <div class="input-group">
                    <input type="text" class="form-control inputFileVisible" placeholder="Single File">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-fab btn-round btn-primary">
                            <i class="material-icons">attach_file</i>
                        </button>
                    </span>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev Geohidrologi - Water Meter-->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Geohidrologi</h4>
            <p class="card-category">Monitoring Water Mater</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="month" name="waktu" class="form-control" id="waktu">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="lokasi">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hasil_wmk">Hasil WMK</label>
                    <input type="number" name="hasil_wmk" step="0.01" class="form-control" id="hasil_wmk">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hasil_wmb">Hasil WMB</label>
                    <input type="number" name="hasil_wmb" step="0.01" class="form-control" id="hasil_wmb">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="kondisi">Keterangan (Kondisi)</label>
                <textarea name="kondisi" class="form-control" rows="5" id="kondisi"></textarea>
              </div>
              <div class="form-group form-file-upload form-file-multiple">
                <input type="file" multiple="" class="inputFileHidden">
                <div class="input-group">
                    <input type="text" class="form-control inputFileVisible" placeholder="Single File">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-fab btn-round btn-primary">
                            <i class="material-icons">attach_file</i>
                        </button>
                    </span>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev Geohidrologi - filter layer-->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Geohidrologi</h4>
            <p class="card-category">Monitoring Lapisan Penyaring</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="month" name="waktu" class="form-control" id="waktu">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" name="posisi" class="form-control" id="posisi">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="kondisi">Keterangan (Kondisi)</label>
                <textarea name="kondisi" class="form-control" rows="5" id="kondisi"></textarea>
              </div>
              <div class="form-group form-file-upload form-file-multiple">
                <input type="file" multiple="" class="inputFileHidden">
                <div class="input-group">
                    <input type="text" class="form-control inputFileVisible" placeholder="Single File">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-fab btn-round btn-primary">
                            <i class="material-icons">attach_file</i>
                        </button>
                    </span>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev Kawasan Candi-->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Geohidrologi</h4>
            <p class="card-category">Monitoring Lapisan Penyaring</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="waktu">Judul</label>
                <input type="text" name="judul" class="form-control" id="judul">
              </div>
              <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="month" name="waktu" class="form-control" id="waktu">
              </div>
              <div class="form-group">
                <label for="instansi">Instansi</label>
                <input type="text" name="instansi" class="form-control" id="instansi">
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan (Kondisi)</label>
                <textarea name="keterangan" class="form-control" rows="5" id="keterangan"></textarea>
              </div>
              <div class="form-group form-file-upload form-file-multiple">
                <input type="file" multiple="" class="inputFileHidden">
                <div class="input-group">
                    <input type="text" class="form-control inputFileVisible" placeholder="Single File">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-fab btn-round btn-primary">
                            <i class="material-icons">attach_file</i>
                        </button>
                    </span>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

    <!-- Monev Pemanfaatan - TIngkat dan Profil Pengunjung-->
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="hader-title">Monev Geohidrologi</h4>
            <p class="card-category">Tingkat Pengunjung dan Profil Pengunjung</p>
          </div>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="month" name="waktu" class="form-control" id="waktu">
              </div>
              <div class="form-group">
                <label for="inputState">Candi</label>
                <select id="inputState" class="form-control">
                  <optgroup label="Wisatawan Nusantara">
                    <option>Pelajar/Mahasiswa</option>
                    <option>Umum</option>
                    <option>Dinas</option>
                  </optgroup>
                  <optgroup label="Wisatawan Mancanegara">
                    <option>Mancanegara</option>
                  </optgroup>
                </select>
              </div>
              <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" name="jumlah" class="form-control" id="jumlah">
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="5" id="keterangan"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- END -->

  </div>
</div>
@endsection
@push('styles')

@endpush
@push('scripts')

@endpush

@push('styles')
<!-- Data table -->
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap4.min.css') }}">
<style>
  .th-index{
    width:5%;
  }
  .th-actions{
    width:15%;
  }
  td a.btn-sm{
    padding: 0.40625rem 0.5rem !important;
  }
</style>
@endpush
@push('scripts')
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
<script>
//Select2 Create
$(".select2").select2({
  tags: true
});
</script>
@endpush