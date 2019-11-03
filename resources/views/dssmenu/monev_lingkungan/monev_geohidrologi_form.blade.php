{!! Form::model($model,[
    'route' => $model->exists ? ['monev_geohidrologi.update', $model->id] : 'monev_geohidrologi.store',
    'files' => true
]) !!}
    <div class="form-group">
        <label for="candi_id">Pilih Cagar Buudaya</label>
        {!! Form::select('candi_id', $cagar, null, ['class' => 'form-control', 'id' => 'candi_id']) !!}
    </div>
    <div class="form-group">
    <label for="judul">Judul</label>
    {!! Form::text('judul',null,['class' => 'form-control', 'id' => 'judul']) !!}
    </div>
    <div class="form-group">
    <label for="tujuan">Tujuan</label>
    {!! Form::textarea('tujuan', null, ['id' => 'tujuan', 'class' => 'form-control', 'rows' => '5', 'id' => 'tujuan']) !!}
    </div>
    <div class="form-group">
    <label for="sasaran">Sasaran</label>
    {!! Form::textarea('sasaran', null, ['id' => 'sasaran', 'class' => 'form-control', 'rows' => '5', 'id' => 'sasaran']) !!}
    </div>
    <div class="form-group">
    <label for="target">Target</label>
    {!! Form::textarea('target', null, ['id' => 'target', 'class' => 'form-control', 'rows' => '5', 'id' => 'target']) !!}
    </div>
    <div class="form-group">
    <label for="metode">Metode</label>
    {!! Form::textarea('metode', null, ['id' => 'metode', 'class' => 'form-control', 'rows' => '5', 'id' => 'metode']) !!}
    </div>
    <div class="form-row">
    <div class="col-md-6">  
        <div class="form-group">
        <label for="tanggal_mulai">Mulai</label>
        {!! Form::date('mulai',null,['class' => 'form-control', 'id' => 'mulai']) !!}
        </div>
    </div>
    <div class="col-md-6">  
        <div class="form-group">
        <label for="tanggal_selesai">Selesai</label>
        {!! Form::date('selesai',null,['class' => 'form-control', 'id' => 'selesai']) !!}
        </div>
    </div>
    </div>
    <div class="form-group">
    <label for="metode">Hasil</label>
    {!! Form::textarea('hasil', null, ['id' => 'hasil', 'class' => 'form-control', 'rows' => '5', 'id' => 'hasil']) !!}
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