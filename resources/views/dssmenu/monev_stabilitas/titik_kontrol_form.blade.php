{!! Form::model($model,[
    'route' => $model->exists ? ['titik_kontrol.update', $model->id] : 'titik_kontrol.store',
    'files' => true
]) !!}
    <div class="form-group">
        <label for="inputState">Pilih Cagar Budaya</label>
        {!! Form::select('candi_id', $cagar, null, ['class' => 'form-control', 'id' => 'candi_id']) !!}
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="koordinat">Nama Koordinat</label>
        {!! Form::text('nama_koordinat',null,['class' => 'form-control', 'id' => 'nama_koordinat']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label for="titik">Titik</label>
        {!! Form::text('titik',null,['class' => 'form-control', 'id' => 'titik']) !!}
        </div>
        </div>
    </div>
    </div>
    <div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
        <label for="sumbux">Sumbu <b>X</b></label>
        {!! Form::number('sumbu_x',null,['class' => 'form-control', 'step' => '0.001', 'id' => 'sumbu_x']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <label for="sumbuy">Sumbu <b>Y</b></label>
        {!! Form::number('sumbu_y',null,['class' => 'form-control', 'step' => '0.001', 'id' => 'sumbu_y']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <label for="sumbuz">Sumbu <b>Z</b></label>
        {!! Form::number('sumbu_z',null,['class' => 'form-control', 'step' => '0.001', 'id' => 'sumbu_z']) !!}
        </div>
    </div>
    </div>
{!! Form::close() !!}