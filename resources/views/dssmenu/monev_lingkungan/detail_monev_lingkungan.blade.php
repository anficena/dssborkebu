<table class="table borderless">
    <tr><td>ID Monev</td><td>: {{ $model[0]->id}}</td></tr>
    <tr><td>Candi</td><td>: {{ $model[0]->candi->nama }}</td></tr>
    <tr><td>Judul</td><td>: {{ $model[0]->judul }}</td></tr>
    <tr><td>Tujuan</td><td>: {!! nl2br(e($model[0]->tujuan)) !!}</td></tr>
    <tr><td>Sasaran</td><td>: {!! nl2br(e($model[0]->sasaran)) !!}</td></tr>
    <tr><td>Target</td><td>: {!! nl2br(e($model[0]->target)) !!}</td></tr>
    <tr><td>Metode</td><td>: {!! nl2br(e($model[0]->metode)) !!}</td></tr>
    <tr><td>Waktu</td><td>: {{ $model[0]->mulai }} - {{ $model[0]->selesai }}</td></tr>
    <tr><td>Hasil</td><td>: {!! nl2br(e($model[0]->hasil)) !!}</td></tr>
    <tr>
        <td>File</td>
        <td>:
            @if(!empty($model[0]->file))
                <a href="{{ $model[0]->file }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
            @else
                <span class="badge badge-danger"><i class="material-icons">assignment</i>&nbsp;file tidak tersedia</span>
            @endif
        </td>
    </tr>
    <tr><td>Penginput</td><td>: {{ Auth::user()->name }}</td></tr>
</table>
<style>
    .borderless td, .borderless th {
        border: none;
    }
    table td:nth-child(1){
        width: 20%;
    }
</style>