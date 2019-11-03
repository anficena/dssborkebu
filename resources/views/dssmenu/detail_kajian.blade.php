<div class="row">
    <div class="col-md-12">
        <h3 class="title text-center">{{ $kajian->judul }}</h3>
        <h5 class="text-center">Oleh: {{ $kajian->penulis }}</h5>
        <h5><strong>ABSTRAK</strong></h5>
        <p style="font-size:14px;">{{$kajian->abstrak}}</p>

    </div>
</div>
<table class="table borderless">
    <tr>
        <td class="text-right desc-text-bold">Kategori</td>
        <td class="desc-text">: {{ $kajian->kategori }}</td>
    </tr>
    <tr>
        <td class="text-right desc-text-bold">Keyword</td>
        <td>
            @foreach($kajian->tags as $tag)
                <label class="badge badge-info">{{ $tag->name }}</label>
            @endforeach
        </td>
    </tr>
    <tr>
        <td class="text-right desc-text-bold">File/Dokumen</td>
        <td class="desc-text">:
            @if(!empty($kajian->file))
                <a href="{{ $kajian->file }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
            @else
                <label class="label label-warning"><i class="fa fa-fw fa-file-text"></i>&nbsp;file tidak tersedia</label>
            @endif
        </td>
    </tr>
</table>
<style>

    .label-warning{
        background-color: #f39c12;
        color: #ffffff;
        border-radius: 4px;
        padding: 3px; 
    }

    .borderless td, .borderless th {
        border: none;
    }
    table td:nth-child(1){
        width: 20%;
    }

    .desc-text{
        font-size: 14px;
    }
    .desc-text-bold{
        font-size: 14px;
        font-weight: 500;
    }
</style>

                <!-- <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title">Judul</h4>
                        <p class="card-category">Pada sesungguhnya kemerdekaan </p>
                        <h4 class="card-title">Penulis</h4>
                        <p>{!! nl2br(e($kajian->penulis)) !!}</p>
                        <h4 class="card-title">Instansi</h4>
                        <p class="card-category">{{$kajian->instansi}}</p>
                        <h4 class="card-title">Kategori</h4>
                        <p class="card-category">{{$kajian->kategori}}</p>
                    
                        <h4 class="card-title">File / Dokumen</h4>
                        <p class="card-category">
                        
                        </p>
                        <h4 class="card-title">Keterangan</h4>
                        <p class="card-category">{{$kajian->keterangan}}</p>
                    </div>
                </div> -->