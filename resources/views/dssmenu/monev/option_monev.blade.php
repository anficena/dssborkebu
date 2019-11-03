<!-- Opsi pilihan -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Kategori Monitoring dan Evaluasi</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    
                        <span data-notify="message">Jika didalam pilihan kategori monev terdapat <strong>FORM UTAMA MONEV</strong>,
                        maka silahkan isi terlebih dahulu sebelum menginputkan data-data pada submenu di bawahnya.</span> Berikut juga disediakan template untuk import data, pastikan sesuaikan dengan aturan yang sudah ditentukan.
                            <ol>
                                <li><a href="{{ asset('/template_import/kemiringan_dindind.xlsx') }}"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Import data kemiringan dinding</a></li>
                                <li><a href="{{ asset('/template_import/titik_kontrol.xlsx') }}"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Import data titik kontrol</a></li>
                                <li><a href="{{ asset('/template_import/klimatologi.xlsx') }}"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Import data klimatologi</a></li>
                                <li><a href="{{ asset('/template_import/kedalaman_sumur.xlsx') }}"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Import data sumur penduduk</a></li>
                                <li><a href="{{ asset('/template_import/kedalaman_resapan.xlsx') }}"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Import data sumur resapan</a></li>
                            </ol>
                    
                <form>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <select class="custom-select" onchange="location = this.value;" id="inputGroupSelect02">
                                    <option value="" disabled selected>Pilih kategori...</option>
                                    <optgroup label="Monev Keterawan Batu">
                                        <option value="{{ route('monev_batu.index') }}">Keterawan Batu</option>
                                    </optgroup>
                                    <optgroup label="Monev Stabilitas Struktur dan Bukit">    
                                        <option value="{{ route('monev_stabilitas.index') }}">Form Utama Monev Stabilitas</option>   
                                        <option value="{{ route('titik_kontrol.index') }}">Koordinat Titik Kontrol</option>
                                        <option value="{{ route('kemiringan_dinding.index') }}">Kemiringan Dinding</option>
                                    </optgroup>
                                    <optgroup label="Monev Lingkungan">   
                                        <option value="{{ route('monev_lingkungan.index') }}">Form Utama Monev Lingkungan</option>  
                                        <option value="{{ route('iklim.index') }}">Klimatologi</option>
                                        <!-- <option value="{{ route('flora.index') }}">Pendataan Flora</option>
                                        <option value="{{ route('fauna.index') }}">Pendataan Fauna</option>
                                        <option value="{{ route('bak.index') }}">Analisis Air Bak Kontrol</option>
                                        <option value="{{ route('sumur.index') }}">Analisis Air Sumur Penduduk</option>
                                        <option value="{{ route('udara.index') }}">Kualitas Udara</option>
                                        <option value="{{ route('kebisingan.index') }}">Monitoring Tingkat Kebisingan</option> -->
                                    </optgroup>
                                    <optgroup label="Monev Geohidrologi">     
                                        <option value="{{ route('monev_geohidrologi.index') }}">Form Utama Monev Geohidrologi</option>  
                                        <option value="{{ route('kedalaman_sumur.index') }}">Kedalaman sumur penduduk</option>
                                        <option value="{{ route('kedalaman_resapan.index') }}">Kedalaman sumur peresapan</option>
                                        <!-- <option value="{{ route('water_mater.index') }}">Monitoring water mater</option>
                                        <option value="{{ route('filter_layer.index') }}">Efektivitas lapisan penyaring</option> -->
                                    </optgroup>
                                    <optgroup label="Monev Kawasan Candi">     
                                        <option value="{{ route('monev_kawasan.index') }}">Kawasan Candi</option>
                                    </optgroup>
                                    <optgroup label="Monev Pemanfaatan">  
                                        <option value="{{ route('monev_pemanfaatan.index') }}">Form Utama Monev Pemanfaatan</option>     
                                        <option value="{{ route('tingkat_pengunjung.index') }}">Tingkat dan Profil Pengunjung</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- END -->