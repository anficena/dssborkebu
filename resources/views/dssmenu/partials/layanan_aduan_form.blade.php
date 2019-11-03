{!! Form::model($model,[
    'route' => $model->exists ? ['layanan_aduan.update', $model->id] : 'layanan_aduan.store',
]) !!}
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="temuan">Tamu</label>
            {!! Form::text('tamu',null,['class' => 'form-control', 'id' => 'tamu']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="penemu">Telephone</label>
                {!! Form::text('telephone',null,['class' => 'form-control', 'id' => 'telephone']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        {!! Form::textarea('alamat',null,['class' => 'form-control', 'id' => 'alamat', 'rows' => '3']) !!}
    </div>
    <div class="form-group">
        <label for="keperluan">Keperluan</label>
        {!! Form::textarea('keperluan',null,['class' => 'form-control', 'id' => 'keperluan', 'rows' => '3']) !!}
    </div>
    <div class="form-group">
        <label for="lokasi">Tindak Lanjut</label>
        {!! Form::textarea('tindakan',null,['class' => 'form-control', 'id' => 'tindakan', 'rows' => '3']) !!}
    </div>
{!! Form::close() !!}