{!! Form::model($model,[
    'route' => $model->exists ? ['iklim.update', $model->id] : 'iklim.store',
]) !!}
    <div class="form-group">
        <label for="observasi_id">Pilih Jenis Observasi</label>
        {!! Form::select('observasi_id', $observasi, null, ['class' => 'form-control', 'id' => 'observas_id']) !!}
    </div>
    <div class="form-group">
        <label for="data">Judul Data (Yang Diteliti)</label>
        {!! Form::select('nama_data', $data, null, ['class' => 'form-control select2', 'id' => 'data']) !!}
    </div>
    <div class="form-group">
        <label for="waktu">Waktu</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'waktu']) !!}
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="hasil">Hasil</label>
                {!! Form::text('hasil',null,['class' => 'form-control', 'id' => 'hasil']) !!}
            </div>
        </div>
        <div class="col-md-6">
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