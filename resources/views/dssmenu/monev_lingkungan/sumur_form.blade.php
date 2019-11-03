{!! Form::model($model,[
    'route' => $model->exists ? ['sumur.update', $model->id] : 'sumur.store',
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
  <div class="form-group">
    <label for="parameter">Parameter</label>
    {!! Form::select('parameter', $parameter, null, ['class' => 'form-control select2', 'id' => 'parameter']) !!}
  </div>
  <div class="form-row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="hasil">Hasil</label>
        {!! Form::text('hasil',null,['class' => 'form-control', 'id' => 'hasil']) !!}
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="standar">Standar</label>
        {!! Form::text('standar',null,['class' => 'form-control', 'id' => 'standar']) !!}
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="satuan">Satuan</label>
        {!! Form::text('satuan',null,['class' => 'form-control', 'id' => 'satuan']) !!}
      </div>
    </div>
  </div>
{!! Form::close() !!}
<style>
.select2{
    font-size: 11pt;
}
</style>
<script>
$(".select2").select2({
  tags: true
});
</script>