{!! Form::model($dokumentasi,[
    'route' => $dokumentasi->exists ? ['dokumentasi.update', $dokumentasi->id] : 'dokumentasi.store',
    'files' => true
]) !!}
    <div class="alert alert-info" role="alert">
        Perhatian: Jika file dalam bentuk link silahkan isikan pada kolom link, sebaliknya jika dalam bentuk file silahkan isikan pada kolom file.
    </div>
    <div class="form-group">
        <label for="judul">Judul</label>
        {!! Form::text('judul',null,['class' => 'form-control', 'id' => 'judul']) !!}
    </div>
    <div class="form-group">
        <label for="data">Kategori</label>
        {!! Form::select('kategori', $data, null, ['class' => 'form-control select2', 'id' => 'kategori']) !!}
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('thumbnail',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'thumbnail']) !!}
        <div class="input-group">
            {!! Form::text('thumbnail_text',null,['class' => 'form-control inputFileVisible', 'id' => 'thumbnail_text', 'placeholder' => 'Pilih thumbnail...']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="keterangan">Link File</label>
        {!! Form::text('link',null,['class' => 'form-control', 'id' => 'link', 'placeholder' => 'http://youtube.com/?q=wonderful_indonesia']) !!}
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('file',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('file_text',null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih File']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        {!! Form::textarea('keterangan', null, ['id' => 'keterangan', 'class' => 'form-control', 'rows' => '5']) !!}
    </div>
{!! Form::close() !!}

<style>
.select2{
    font-size: 11pt;
}
.alert{
    font-size: 11pt;
    padding: 10px 10px;
    margin-bottom: 40px;
}
</style>
<script>
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