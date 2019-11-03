{!! Form::model($model,[
    'route' => $model->exists ? ['mow.update', $model->id] : 'mow.store',
]) !!}
    
    <div class="form-group">
        <label for="observasi_id">Pilih MOW</label>
        {!! Form::hidden('mow','mow') !!}
        {!! Form::select('dokumentasi_id', $mow, null, ['class' => 'form-control', 'id' => 'dokumentasi_id']) !!}
    </div>
    <div class="form-group">
        <label for="jumlah">Nama Koleksi</label>
        {!! Form::text('koleksi',null,['class' => 'form-control', 'id' => 'koleksi']) !!}
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
                <label for="satuan">Terkonservasi</label>
                {!! Form::text('terkonservasi',null,['class' => 'form-control', 'id' => 'terkonservasi']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="keterangan">Tindakan</label>
        {!! Form::textarea('tindakan',null,['class' => 'form-control', 'id' => 'tindakan', 'rows' => '5']) !!}
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