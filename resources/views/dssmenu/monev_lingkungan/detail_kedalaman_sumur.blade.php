<table class="table borderless">
    <tr><td>Observasi ID</td><td>: {{ $model->observasi_id }}</td></tr>
    <tr><td>Waktu</td><td>: {{ $model->waktu }}</td></tr>
    <tr><td>Lokasi</td><td>: {{ $model->lokasi }}</td></tr>
    <tr><td>Kedalaman</td><td>: {{ $model->kedalaman }}</td></tr>
    <tr>
        <td>Photo</td>
        <td>:
            @if(!empty($model->photo))
                <a href="{{ $model->photo }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
            @else
                <span class="badge badge-danger"><i class="material-icons">assignment</i>&nbsp;file tidak tersedia</span>
            @endif
        </td>
    </tr>
    <tr><td>Keterangan</td><td>: {{ $model->kondisi }}</td></tr>
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