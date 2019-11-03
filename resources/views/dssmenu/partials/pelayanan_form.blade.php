{!! Form::model($pelayanan,[
    'route' => $pelayanan->exists ? ['pelayanan.update', $pelayanan->id] : 'pelayanan.store',
    'files' => true
]) !!}
    <div class="form-group">
        <label for="perihal">Perihal</label>
        {!! Form::text('perihal',null,['class' => 'form-control', 'id' => 'perihal']) !!}
    </div>
    <div class="form-group">
        <label for="pengirim">Pengirim</label>
        {!! Form::text('pengirim',null,['class' => 'form-control', 'id' => 'pengirim']) !!}
    </div>
    <div class="form-group">
        <label for="kategori">Penerima</label>
        {!! Form::text('penerima',null,['class' => 'form-control', 'id' => 'penerima']) !!}
    </div>
    <div class="form-group">
        <label class="label-control">Tanggal</label>
        {!! Form::text('tanggal',null,['class' => 'form-control datetimepicker', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        {!! Form::text('status',null,['class' => 'form-control', 'id' => 'status']) !!}
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        {!! Form::textarea('keterangan', null, ['id' => 'keterangan', 'class' => 'form-control', 'rows' => '5']) !!}
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
  {!! Form::close() !!}
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}">

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

    $('.datetimepicker').datetimepicker({
        format : 'YYYY-MM-DD',
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
