{!! Form::model($model,[
    'route' => $model->exists ? ['fauna.update', $model->id] : 'fauna.store',
]) !!}
    <div class="form-group">
        <label for="observasi_id">Pilih Jenis Observasi</label>
        {!! Form::select('observasi_id', $observasi, null, ['class' => 'form-control', 'id' => 'observas_id']) !!}
    </div>
    <div class="form-group">
        <label for="waktu">Waktu</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'waktu']) !!}
    </div>
    <div class="form-group">
        <label for="waktu">Lokasi</label>
        {!! Form::text('lokasi',null,['class' => 'form-control', 'id' => 'lokasi']) !!}
    </div>
    <div class="form-group">
        <label for="nama">Nama (Flora/Fauna)</label>
        {!! Form::text('nama',null,['class' => 'form-control', 'id' => 'nama']) !!}
    </div>
    <div class="form-group">
        <label for="jenis">Jenis/Kategori</label>
        {!! Form::select('jenis', $jenis, null, ['class' => 'form-control select2', 'id' => 'jenis']) !!}
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="jumlah">Jumlah</label>
            {!! Form::text('jumlah',null,['class' => 'form-control', 'id' => 'jumlah']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="satuan">Satuan</label>
                {!! Form::text('satuan',null,['class' => 'form-control', 'id' => 'satuan']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        {!! Form::text('keterangan',null,['class' => 'form-control', 'id' => 'keterangan']) !!}
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