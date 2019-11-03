{!! Form::model($model,[
    'route' => $model->exists ? ['monev_batu.update', $model->id] : 'monev_batu.store',
]) !!}
    <div class="form-group">
        <label for="candi_id">Pilih Candi</label>
        {!! Form::select('candi_id', $candi, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-group">
        <label for="jenis_observasi">Jenis Observasi</label>
        {!! Form::select('jenis_observasi', $kategori, null, ['class' => 'form-control select2']) !!}
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah</label>
        {!! Form::text('jumlah',null,['class' => 'form-control', 'id' => 'jumlah']) !!}
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