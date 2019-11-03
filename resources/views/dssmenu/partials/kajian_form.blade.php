<link rel="stylesheet" href="{{ asset('bower_components/tag/bootstrap-tagsinput.css') }}">
<script src="{{ asset('bower_components/tag/bootstrap-tagsinput.js') }}"></script>
{!! Form::model($kajian,[
    'route' => $kajian->exists ? ['kajian.update', $kajian->id] : 'kajian.store',
    
    'files' => true
]) !!}
    <div class="form-group">
        <label for="judul">Judul</label>
        {!! Form::text('judul',null,['class' => 'form-control', 'id' => 'judul']) !!}
    </div>
    <div class="form-group">
        <label for="penulis">Penulis</label>
        {!! Form::textarea('penulis', null, ['id' => 'penulis', 'class' => 'form-control', 'rows' => '5']) !!}
    </div>
    <div class="form-group">
        <label class="label-control">Tanggal</label>
        {!! Form::text('tanggal',null,['class' => 'form-control datetimepicker', 'id' => 'datetimepicker']) !!}
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        {!! Form::select('kategori',$kategori, null, ['class' => 'form-control selectpicker', 'data-style' => 'btn btn-link', 'id' => 'kategori']) !!}
    </div>
    <div class="form-group">
        <label for="instansi">Keyword</label>
        @if($kajian->exists)
        {!! Form::text('keyword',$tag,['class' => 'form-control tagsinput', 'data-role' => 'tagsinput', 'id' => 'keyword']) !!}
        @else
        {!! Form::text('keyword',null,['class' => 'form-control tagsinput', 'data-role' => 'tagsinput', 'id' => 'keyword']) !!}
        @endif
        
    </div>
    <div class="form-group">
        <label for="keterangan">Abstrak</label>
        {!! Form::textarea('abstrak', null, ['id' => 'abstrak', 'class' => 'form-control', 'rows' => '5']) !!}
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




<style>

.bootstrap-tagsinput{
  width:100%;
  margin-top:10px;
}

.show>.btn.dropdown-toggle{
    color: #000000;
    background-color: #ffffff;
}

.show>.btn.dropdown-toggle:hover {
    color: #000000;
    background-color: #ffffff;
    border-color: #ffffff;
}

.bootstrap-select .dropdown-toggle .filter-option {
  margin-left: -30px;
}
</style>




<script>


    $('.selectpicker').selectpicker({});

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