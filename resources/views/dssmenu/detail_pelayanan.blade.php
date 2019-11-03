<table class="table borderless">
    <tr><td>Perihal</td><td>: {{ $pelayanan->perihal }}</td></tr>
    <tr><td>Pengirim</td><td>: {{ $pelayanan->pengirim }}</td></tr>
    <tr><td>Penerima</td><td>: {{ $pelayanan->penerima }}</td></tr>
    <tr><td>Tanggal Masuk</td><td>: {{ $pelayanan->tanggal }}</td></tr>
    <tr>
        <td>
            Status
        </td>
        <td>: 
            @if($pelayanan->status=="selesai")
                <span class="badge badge-success">SELESAI</span>
            @else
                <span class="badge badge-danger">GAGAL</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>
            Lampiran File
        </td>
        <td>:
                @if(!empty($pelayanan->file))
                    <a href="{{ $pelayanan->file }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
                @else
                    <span class="badge badge-danger">file tidak tersedia</span>
                @endif
        </td>
    </tr>
    <tr><td>Keterangan</td><td>: {!! nl2br(e($pelayanan->keterangan)) !!}</td></tr>
</table>


<style>
    .borderless td, .borderless th {
            border: none;
    }
    table td:nth-child(1){
        width: 20%;
    }
</style>

        
