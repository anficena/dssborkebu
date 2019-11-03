{!! Form::model($model,[
    'route' => $model->exists ? ['kebisingan.update', $model->id] : 'kebisingan.store',
]) !!}
    <div class="form-group">
      <label for="observasi_id">Pilih Jenis Observasi</label>
      {!! Form::select('observasi_id', $observasi, null, ['class' => 'form-control', 'id' => 'observas_id']) !!}
    </div>
    <div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="waktu">Waktu</label>
        {!! Form::date('waktu',null,['class' => 'form-control', 'id' => 'waktu']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="lokasi">Lokasi</label>
        {!! Form::text('lokasi',null,['class' => 'form-control', 'id' => 'lokasi']) !!}
        </div>
    </div>
    </div>
    <div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="hasil">Hasil</label>
        {!! Form::number('hasil',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'hasil']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="satuan">Satuan</label>
        {!! Form::text('satuan',null,['class' => 'form-control', 'id' => 'satuan']) !!}
        </div>
    </div>
    </div>