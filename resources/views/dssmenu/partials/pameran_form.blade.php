{!! Form::model($pameran,[
    'route' => $pameran->exists ? ['pameran.update', $pameran->id] : 'pameran.store',
    'files' => true
]) !!}
    <div class="form-group">
        <label for="mitra">Nama Pameran</label>
        {!! Form::text('nama',null,['class' => 'form-control', 'id' => 'nama']) !!}
    </div>
    <div class="form-group">
        <label for="koordinator">Tema</label>
        {!! Form::text('tema',null,['class' => 'form-control', 'id' => 'tema']) !!}
    </div>
    <div class="form-group">
        <label class="label-control">Tanggal</label>
        {!! Form::date('tanggal',null,['class' => 'form-control datetimepicker', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-group">
        <label for="perihal">Tempat</label>
        {!! Form::text('tempat',null,['class' => 'form-control', 'id' => 'tempat']) !!}
    </div>
    <div class="form-group">
        <label for="perihal">Latitude</label>
        {!! Form::number('latitude',null,['class' => 'form-control', 'step' => '0,000001', 'id' => 'latitude']) !!}
    </div>
    <div class="form-group">
        <label for="perihal">Longitude</label>
        {!! Form::number('longitude',null,['class' => 'form-control', 'step' => '0,000001', 'id' => 'longitude']) !!}
    </div>
    <div class="form-group">
        <label for="perihal">Jumlah Pengunjung</label>
        {!! Form::number('pengunjung',null,['class' => 'form-control', 'id' => 'pengunjung']) !!}
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('photo',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'photo']) !!}
        <div class="input-group">
            {!! Form::text('photo_text',null,['class' => 'form-control inputFileVisible', 'id' => 'photo_text', 'placeholder' => 'Pilih Photo']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
    </div>
  {!! Form::close() !!}
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}">

<style>
    .select2{
        font-size: 11pt;
    }
</style>

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
