{!! Form::model($model,[
    'route' => $model->exists ? ['layanankpk.update', $model->id] : 'layanankpk.store',
]) !!}
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        {!! Form::hidden('sub_layanan',!($model->exists) ? $layanan : null) !!}
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="tamu">Tamu</label>
            {!! Form::text('tamu',null,['class' => 'form-control', 'id' => 'tamu']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="instansi">Instansi</label>
                {!! Form::text('instansi',null,['class' => 'form-control', 'id' => 'instansi']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        {!! Form::textarea('alamat',null,['class' => 'form-control', 'id' => 'tindakan', 'rows' => '3']) !!}
    </div>
    <div class="form-group">
        <label for="keperluan">Keperluan</label>
        {!! Form::textarea('keperluan',null,['class' => 'form-control', 'id' => 'tindakan', 'rows' => '3']) !!}
    </div>
    @if($model->exists ? (($model->sub_layanan != "laboratorium") && ($model->sub_layanan != "dokumentasi") && ($model->sub_layanan != "perpustakaan")) : (($layanan != "laboratorium") && ($layanan != "dokumentasi") && ($layanan != "perpustakaan")))
    <div class="form-group">
        <label for="lokasi">lokasi</label>
        {!! Form::text('lokasi',null,['class' => 'form-control', 'id' => 'lokasi']) !!}
    </div>
    @endif
    <div class="form-group">
        <label for="lokasi">Jenis Layanan</label>
        {!! Form::text('jenis_layanan',null,['class' => 'form-control', 'id' => 'jenis_layanan']) !!}
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah (Orang)</label>
        {!! Form::number('jumlah',null,['class' => 'form-control', 'id' => 'jumlah', '']) !!}
    </div>
{!! Form::close() !!}