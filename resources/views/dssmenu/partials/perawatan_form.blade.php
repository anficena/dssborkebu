{!! Form::model($model,[
    'route' => $model->exists ? ['perawatan.update', $model->id] : 'perawatan.store',
    'files' => true
]) !!}
    <div class="form-group">
        <label for="kategori">Candi</label>
        {!! Form::select('candi_id', $candi, null, ['class' => 'form-control', 'id' => 'candi_id']) !!}
    </div>
    <div class="form-group">
        <label for="kegiatan">Kegiatan</label>
        {!! Form::text('aktivitas',null,['class' => 'form-control', 'id' => 'aktivitas']) !!}
    </div>
    <div class="form-group">
        <label for="tanggal">Waktu</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        {!! Form::select('kategori', $kategori, null, ['class' => 'form-control select2', 'id' => 'kategori']) !!}
    </div>
    <div class="form-group">
        <label for="lokasi">Posisi/Lokasi</label>
        {!! Form::text('lokasi',null,['class' => 'form-control', 'id' => 'lokasi']) !!}
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        {!! Form::textarea('deskripsi', null, ['id' => 'deskripsi', 'class' => 'form-control', 'rows' => '5']) !!}
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('gambar',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('file_text',null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih File']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
{!! Form::close() !!}


<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<style>
.select2{
    font-size: 11pt;
}
</style>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
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