{!! Form::model($model,[
    'route' => $model->exists ? ['kedalaman_sumur.update', $model->id] : 'kedalaman_sumur.store',
]) !!}
    <div class="form-group">
        <label for="observasi_id">Pilih Jenis Observasi</label>
        {!! Form::select('observasi_id', $observasi, null, ['class' => 'form-control', 'id' => 'observas_id']) !!}
    </div>
    <div class="form-group">
        <label for="waktu">Waktu</label>
        {!! Form::date('waktu',null,['class' => 'form-control', 'id' => 'waktu']) !!}
    </div>
    <div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="lokasi">Lokasi</label>
        {!! Form::select('lokasi',$tempat, null,['class' => 'form-control select2', 'id' => 'lokasi']) !!}
        
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="hasil">Kedalaman</label>
            {!! Form::number('kedalaman',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'kedalaman']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="keterangan">Kondisi</label>
        {!! Form::textarea('kondisi', null, ['id' => 'keterangan', 'class' => 'form-control', 'rows' => '5', 'id' => 'kondisi']) !!}
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('photo',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'photo']) !!}
        <div class="input-group">
            {!! Form::text('photo_text',null,['class' => 'form-control inputFileVisible', 'id' => 'photo_text', 'placeholder' => 'Pilih File']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
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