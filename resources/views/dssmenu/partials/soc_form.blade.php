{!! Form::model($soc,[
    'route' => $soc->exists ? ['soc.update', $soc->id] : 'soc.store',
    'files' => true
]) !!}
    <div class="form-group">
        <label for="judul">Id_Decision</label>
        {!! Form::text('decision_id',null,['class' => 'form-control', 'id' => 'decision_id']) !!}
    </div>
    <div class="form-group">
        <label class="label-control">Tanggal</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-group">
        <label for="instansi">Decision</label>
        {!! Form::text('decision',null,['class' => 'form-control', 'id' => 'decision']) !!}
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        {!! Form::select('kategori', $kategori, null, ['class' => 'form-control select2']) !!}
    </div>
    <div class="form-group">
        <label for="perihal">Latitude</label>
        {!! Form::number('latitude',null,['class' => 'form-control', 'step' => '0,000001', 'id' => 'latitude']) !!}
    </div>
    <div class="form-group">
        <label for="perihal">Longitude</label>
        {!! Form::number('longitude',null,['class' => 'form-control', 'step' => '0,000001', 'id' => 'longitude']) !!}
    </div>
    <div class="form-group form-file-upload form-file-multiple">
        {!! Form::file('image',['class' => 'inputFileHidden', 'multiple' => '', 'id' => 'file']) !!}
        <div class="input-group">
            {!! Form::text('image_text',null,['class' => 'form-control inputFileVisible', 'id' => 'file_text', 'placeholder' => 'Pilih Gambar']) !!}
            <span class="input-group-btn">
                <button type="button" class="btn btn-fab btn-round btn-primary">
                    <i class="material-icons">attach_file</i>
                </button>
            </span>
        </div>
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
</style>
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
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

    $('.datetimepicker').datetimepicker({
        format : 'YYYY-MM-DD HH:mm',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
</script>

