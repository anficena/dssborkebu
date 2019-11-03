{!! Form::model($model,[
    'route' => $model->exists ? ['monev_stabilitas.update', $model->id] : 'monev_stabilitas.store',
    'files' => true
]) !!}
    <div class="form-group">
        <label for="inputState">Pilih Cagar Budaya</label>
        {!! Form::select('candi_id', $cagar, null, ['class' => 'form-control', 'id' => 'candi_id']) !!}
    </div>
    <div class="form-group">
        <label for="tanggal">Judul</label>
        {!! Form::text('judul',null,['class' => 'form-control', 'id' => 'judul']) !!}
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('file[0]',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('file_text[]',$model->exists ? $file_text[0] : null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih file pengertian', 'required' => 'required']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('file[1]',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('file_text[]',$model->exists ? $file_text[1] : null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih file spesifikasi dan alat kerja']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('file[2]',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('file_text[]',$model->exists ? $file_text[2] : null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih file pedoman pengukuran']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('file[3]',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('file_text[]',$model->exists ? $file_text[3] : null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih file foto kegiatan']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('file[4]',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('file_text[]',$model->exists ? $file_text[4] : null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih file gambar kerja']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('file[5]',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('file_text[]',$model->exists ? $file_text[5] : null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih file referensi & acuan']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
{!! Form::close() !!}

<script>
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