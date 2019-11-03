<table class="table borderless">
    <tr><td>Mitra</td><td>: {{ $kemitraan->mitra }}</td></tr>
    <tr><td>Koordinator</td><td>: {{ $kemitraan->koordinator }}</td></tr>
    <tr><td>Perihal</td><td>: {{ $kemitraan->perihal }}</td></tr>
    <tr><td>Kategori</td><td>: {{ $kemitraan->kategori }}</td></tr>
    <tr><td>Mulai</td><td>: {{ $kemitraan->mulai }}</td></tr>
    <tr><td>Selesai</td><td>: {{ $kemitraan->selesai }}</td></tr>
    <tr>
        <td>
            Lampiran File
        </td>
        <td>:
                @if(!empty($kemitraan->file))
                    <a href="{{ $kemitraan->file }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
                @else
                    <span class="badge badge-danger">file tidak tersedia</span>
                @endif
        </td>
    </tr>
    <tr><td>Keterangan</td><td>: {!! nl2br(e($kemitraan->keterangan)) !!}</td></tr>
</table>


<style>
    .borderless td, .borderless th {
            border: none;
    }
    table td:nth-child(1){
        width: 20%;
    }
</style>

        
