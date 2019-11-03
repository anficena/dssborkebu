<table class="table borderless">
    <tr><td>Candi_ID</td><td>: {{ $perawatan->candi_id }}</td></tr>
    <tr><td>Aktivitas</td><td>: {{ $perawatan->aktivitas }}</td></tr>
    <tr><td>Tanggal</td><td>: {{ $perawatan->tanggal }}</td></tr>
    <tr><td>Kategori</td><td>: {{ $perawatan->kategori }}</td></tr>
    <tr><td>Lokasi</td><td>: {{ $perawatan->lokasi }}</td></tr>
    <tr>
        <td>Dokumentasi Kegiatan</td>
        <td>:
            @if(!empty($perawatan->gambar))
                <a href="{{ $perawatan->gambar }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
            @else
                <a class="text-danger"><i class="material-icons">assignment</i>&nbsp;file tidak tersedia</span>
            @endif
        </td>
    </tr>
    <tr><td>Deskripsi</td><td>: {!! nl2br(e($perawatan->deskripsi)) !!}</td></tr>
    <tr><td>Pengirim</td><td>: {{ Auth::user()->name }}</td></tr>
</table>
<style>
    .borderless td, .borderless th {
        border: none;
    }
    table td:nth-child(1){
        width: 20%;
    }
</style>