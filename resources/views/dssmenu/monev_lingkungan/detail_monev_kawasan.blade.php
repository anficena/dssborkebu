<table class="table borderless">
    <tr><td>Candi ID</td><td>: {{ $model->candi_id }}</td></tr>
    <tr><td>Judul</td><td>: {{ $model->judul }}</td></tr>
    <tr><td>Tanggal</td><td>: {{ $model->tanggal }}</td></tr>
    <tr><td>Instansi</td><td>: {{ $model->instansi }}</td></tr>
    <tr>
        <td>File</td>
        <td>:
            @if(!empty($model->File))
                <a href="{{ $model->file }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
            @else
                <span class="badge badge-danger"><i class="material-icons">assignment</i>&nbsp;file tidak tersedia</span>
            @endif
        </td>
    </tr>
    <tr><td>Keterangan</td><td>: {{ $model->keterangan }}</td></tr>
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