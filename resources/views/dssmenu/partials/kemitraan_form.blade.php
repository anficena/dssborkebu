{!! Form::model($kemitraan,[
    'route' => $kemitraan->exists ? ['kemitraan.update', $kemitraan->id] : 'kemitraan.store',
    'files' => true
]) !!}
    <div class="form-group">
        <label for="mitra">Nama Mitra</label>
        {!! Form::text('mitra',null,['class' => 'form-control', 'id' => 'mitra']) !!}
    </div>
    <div class="form-group">
        <label for="koordinator">Koordinator</label>
        {!! Form::text('koordinator',null,['class' => 'form-control', 'id' => 'koordinator']) !!}
    </div>
    <div class="form-group">
        <label for="perihal">Perihal</label>
        {!! Form::text('perihal',null,['class' => 'form-control', 'id' => 'perihal']) !!}
    </div>
    <div class="form-group">
        <label for="status">Kategori</label>
        {!! Form::select('kategori', $kategori, null, ['class' => 'form-control select2', 'id' => 'kategori']) !!}
    </div>
    <div class="form-group">
        <label class="label-control">Tanggal Mulai</label>
        {!! Form::text('mulai',null,['class' => 'form-control datetimepicker', 'id' => 'mulai']) !!}
    </div>
    <div class="form-group">
        <label class="label-control">Tanggal Selesai</label>
        {!! Form::text('selesai',null,['class' => 'form-control datetimepicker', 'id' => 'selesai']) !!}
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
