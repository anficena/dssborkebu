<table class="table borderless">
    <tr><td>ID Decision</td><td>: {{ $soc->decision_id }}</td></tr>
    <tr><td>Tanggal</td><td>: {{ $soc->tanggal }}</td></tr>
    <tr><td>Decision</td><td>: {{ $soc->decision }}</td></tr>
    <tr><td>Kategori</td><td>: {{ $soc->kategori }}</td></tr>
    <tr>
        <td>File/Dokumen</td>
        <td>:
            @if(!empty($soc->file))
                <a href="{{ $soc->file }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
            @else
                <a class="text-danger"><i class="material-icons">assignment</i>&nbsp;file tidak tersedia</span>
            @endif
        </td>
    </tr>
    <tr><td>Keterangan</td><td>: {!! nl2br(e($soc->keterangan)) !!}</td></tr>
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