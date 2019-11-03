<table class="table borderless">
    <tr><td>Observasi ID</td><td>: {{ $model->observasi_id }}</td></tr>
    <tr><td>Tanggal</td><td>: {{ $model->tanggal }}</td></tr>
    <tr><td>Lokasi</td><td>: {{ $model->lokasi }}</td></tr>
    <tr><td>Nama</td><td>: {{ $model->nama }}</td></tr>
    <tr><td>Jenis</td><td>: {{ $model->jenis }}</td></tr>
    <tr><td>Jumlah</td><td>: {{ $model->jumlah }}</td></tr>
    <tr><td>Satuan</td><td>: {{ $model->satuan }}</td></tr>
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