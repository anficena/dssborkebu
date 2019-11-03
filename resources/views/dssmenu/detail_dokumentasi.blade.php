<div class="row">
    <div class="col-md-12">
        <h3 class="title">{{ $dokumentasi->judul }}</h3>
        <p>
            <i class="fa fa-fw fa-calendar"></i><strong>Uploaded</strong> : {{ $dokumentasi->created_at }} &ensp; 
            <i class="fa fa-fw fa-folder-open-o"></i><strong>Kategori</strong>: {{ $dokumentasi->kategori }}</p>
        
        @if(!empty(Auth::user()->id))    
        @if(!empty($dokumentasi->thumbnail))
        <strong>Thumbnail:</strong><br/>
            <img src="{{$dokumentasi->thumbnail}}" alt="{{$dokumentasi->judul}}" class="img-thumbnail">
        @else
            <p>Tidak ada thumbnail</p>
        @endif
        <br/><br/>
        @endif

        @if((($dokumentasi->kategori) == "video"))
            <strong>Preview:</strong>
            @if((!empty($dokumentasi->link)))
                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                    <iframe class="embed-responsive-item" src="{{$dokumentasi->link}}"></iframe>
                </div>
                <br/>
            @endif
            @if((!empty($dokumentasi->file)))
                <video class="embed-responsive embed-responsive-16by9 z-depth-1-half" controls>
                    <source src="{{$dokumentasi->file}}" type="video/mp4">
                    <source src="{{$dokumentasi->file}}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
                <br/>
            @endif
        @elseif($dokumentasi->kategori == "photo")
            @if((!empty($dokumentasi->file)))
                <strong>Photo:</strong><br/>
                <img src="{{$dokumentasi->file}}" alt="{{$dokumentasi->file}}" class="img-thumbnail">
            @endif
        @elseif(($dokumentasi->kategori == "mow") || ($dokumentasi->kategori == "arsitektur"))
            @if((!empty($dokumentasi->file)))
                <strong>Dokumen terlampir:</strong><br/>
                @if(!empty($dokumentasi->file))
                    @if(substr($dokumentasi->file, strrpos($dokumentasi->file, '.' )+1) == "pdf")
                        <a href="{{ $dokumentasi->file }}"><i class="material-icons">assignment</i>&nbsp;Download File</a>
                    @else
                        <img src="{{$dokumentasi->file}}" alt="{{$dokumentasi->file}}" class="img-thumbnail">     
                    @endif
                    <br/>
                @endif
            @else
                <label class="label label-warning"><i class="fa fa-fw fa-file-text"></i>&nbsp;File tidak tersedia</label>
            @endif
        @endif
        <!-- substr($my_url, strrpos($my_url, '/' )+1)."\n"; -->
        <br/>
        <strong>Keterangan:</strong>
        <p class="text-justify">{{$dokumentasi->keterangan}}</p>
    </div>
</div>
