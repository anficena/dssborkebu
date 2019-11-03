{!! Form::model($model,[
    'route' => $model->exists ? ['layanan_temuan.update', $model->id] : 'layanan_temuan.store',
]) !!}
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="temuan">Jenis Temuan</label>
            {!! Form::text('jenis_temuan',null,['class' => 'form-control', 'id' => 'jenis_temuan']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="penemu">Penemu</label>
                {!! Form::text('penemu',null,['class' => 'form-control', 'id' => 'penemu']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        {!! Form::textarea('alamat',null,['class' => 'form-control', 'id' => 'alamat', 'rows' => '3']) !!}
    </div>
    <div class="form-group">
        <label for="keperluan">Bentuk & Ukuran</label>
        {!! Form::textarea('bentuk',null,['class' => 'form-control', 'id' => 'bentuk', 'rows' => '3']) !!}
    </div>
    <div class="form-group">
        <label for="lokasi">Kompensasi</label>
        {!! Form::text('kompensasi',null,['class' => 'form-control', 'id' => 'kompensasi']) !!}
    </div>
{!! Form::close() !!}