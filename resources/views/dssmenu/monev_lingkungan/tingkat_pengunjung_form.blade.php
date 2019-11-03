{!! Form::model($model,[
    'route' => $model->exists ? ['tingkat_pengunjung.update', $model->id] : 'tingkat_pengunjung.store',
]) !!}
    <div class="form-group">
      <label for="observasi_id">Pilih Jenis Observasi</label>
      {!! Form::select('observasi_id', $observasi, null, ['class' => 'form-control', 'id' => 'observas_id']) !!}
    </div>
    <div class="form-group">
        <label for="waktu">Waktu</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="pelajar">Pelajar</label>
                {!! Form::number('pelajar',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'pelajar']) !!}
            </div>
        </div> 
        <div class="col-md-3">
            <div class="form-group">
                <label for="umum">Umum</label>
                {!! Form::number('umum',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'umum']) !!}
            </div>
        </div> 
        <div class="col-md-3">
            <div class="form-group">
                <label for="dinas">Dinas</label>
                {!! Form::number('dinas',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'dinas']) !!}
            </div>
        </div>  
        <div class="col-md-3">
            <div class="form-group">
                <label for="mancanegara">Mancanegara</label>
                {!! Form::number('mancanegara',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'mancanegara']) !!}
            </div>
        </div> 
    </div>
    <div class="form-group">
        <label for="jumlah">Total</label>
        {!! Form::number('total',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'total']) !!}
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        {!! Form::textarea('keterangan', null, ['id' => 'keterangan', 'class' => 'form-control', 'rows' => '5']) !!}
    </div>
{!! Form::close() !!}