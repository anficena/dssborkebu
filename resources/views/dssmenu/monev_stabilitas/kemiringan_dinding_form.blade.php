{!! Form::model($model,[
    'route' => $model->exists ? ['kemiringan_dinding.update', $model->id] : 'kemiringan_dinding.store'
]) !!}
    <div class="form-group">
        <label for="inputState">Pilih Cagar Budaya</label>
        {!! Form::select('candi_id', $cagar, null, ['class' => 'form-control', 'id' => 'candi_id']) !!}
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        {!! Form::date('tanggal',null,['class' => 'form-control', 'id' => 'tanggal']) !!}
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="koordinat">Nama Lokasi</label>
                {!! Form::text('lokasi',null,['class' => 'form-control', 'id' => 'lokasi']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="titik">Titik</label>
                {!! Form::text('titik',null,['class' => 'form-control', 'id' => 'titik']) !!}
            </div>
        </div>
        </div>
    <div class="form-row">   
        <div class="form-group col-md-12">
            <label for="arahx">Arah sumbu X</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sumbuxa">a (cm)</label>
                {!! Form::number('sumbu_xa',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'sumbu_xa']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sumbuxb">b (cm)</label>
                {!! Form::number('sumbu_xb',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'sumbu_xb']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sumbuxh">H (cm)</label>
                {!! Form::number('sumbu_xh',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'sumbu_xc']) !!}
            </div>
        </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12"><label for="arahy">Arah sumbu Y</label></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sumbuya">a (cm)</label>
                {!! Form::number('sumbu_ya',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'sumbu_ya']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sumbuya">b (cm)</label>
                {!! Form::number('sumbu_yb',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'sumbu_yb']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sumbuyh">H (cm)</label>
                {!! Form::number('sumbu_yh',null,['class' => 'form-control', 'step' => '0.01', 'id' => 'sumbu_yh']) !!}
            </div>
        </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12"><label for="kemiringan">Kemiringan</label></div>   
        <div class="col-md-6">
            <div class="form-group">
                <label for="kemiringan_x">X</label>
                {!! Form::text('kemiringan_x',null,['class' => 'form-control', 'id' => 'kemiringan_x']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="kemiringan_y">Y</label>
                {!! Form::text('kemiringan_y',null,['class' => 'form-control', 'id' => 'kemiringan_y']) !!}
            </div>
        </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12"><label for="pedoman">Sesuai Pedoman</label></div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="pedoman_x">X</label>
            {!! Form::text('pedoman_x',null,['class' => 'form-control', 'id' => 'pedoman_x']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="pedoman_y">Y</label>
            {!! Form::text('pedoman_y',null,['class' => 'form-control', 'id' => 'pedoman_y']) !!}
        </div>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12"><label for="pedoman">Selisih Dibanding Pedoman</label></div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="selisih_x">iX (Menit)</label>
            {!! Form::text('selisih_x',null,['class' => 'form-control', 'id' => 'selisih_x']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="selisih_y">iY (Menit)</label>
            {!! Form::text('selisih_y',null,['class' => 'form-control', 'id' => 'selisih_y']) !!}
        </div>
    </div>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        {!! Form::text('keterangan',null,['class' => 'form-control', 'id' => 'keterangan']) !!}
    </div>
{!! Form::close() !!}
