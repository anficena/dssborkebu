{!! Form::model($model,[
    'route' => $model->exists ? ['monev_kawasan.update', $model->id] : 'monev_kawasan.store',
    'files' => true
]) !!}
    <div class="form-group">
      <label for="observasi_id">Pilih Jenis Observasi</label>
      {!! Form::select('candi_id', $cagar, null, ['class' => 'form-control', 'id' => 'candi_id']) !!}
    </div>
    <div class="form-group">
    <label for="waktu">Judul</label>
    {!! Form::text('judul',null,['class' => 'form-control', 'id' => 'judul']) !!}
    </div>
    <div class="form-group">
    <label for="waktu">Waktu</label>
    {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-group">
    <label for="instansi">Instansi</label>
    {!! Form::text('instansi',null,['class' => 'form-control', 'id' => 'instansi']) !!}
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        {!! Form::textarea('keterangan', null, ['id' => 'keterangan', 'class' => 'form-control', 'rows' => '5', 'id' => 'kondisi']) !!}
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('file',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'photo']) !!}
        <div class="input-group">
            {!! Form::text('file_text',null,['class' => 'form-control inputFileVisible', 'id' => 'photo_text', 'placeholder' => 'Pilih File']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
{!! Form::close() !!}
<style>
.select2{
    font-size: 11pt;
}
</style>
<script>
//Select2 Create
$(".select2").select2({
  tags: true
});

// FileInput
$('.form-file-simple .inputFileVisible').click(function() {
      $(this).siblings('.inputFileHidden').trigger('click');
    });

    $('.form-file-simple .inputFileHidden').change(function() {
      var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
      $(this).siblings('.inputFileVisible').val(filename);
    });

    $('.form-file-multiple .inputFileVisible, .form-file-multiple .input-group-btn').click(function() {
      $(this).parent().parent().find('.inputFileHidden').trigger('click');
      $(this).parent().parent().addClass('is-focused');
    });

    $('.form-file-multiple .inputFileHidden').change(function() {
      var names = '';
      for (var i = 0; i < $(this).get(0).files.length; ++i) {
        if (i < $(this).get(0).files.length - 1) {
          names += $(this).get(0).files.item(i).name + ',';
        } else {
          names += $(this).get(0).files.item(i).name;
        }
      }
      $(this).siblings('.input-group').find('.inputFileVisible').val(names);
    });

    $('.form-file-multiple .btn').on('focus', function() {
      $(this).parent().siblings().trigger('focus');
    });

    $('.form-file-multiple .btn').on('focusout', function() {
      $(this).parent().siblings().trigger('focusout');
    });
</script>