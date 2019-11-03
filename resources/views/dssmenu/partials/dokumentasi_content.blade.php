@foreach($dokumentasi as $d)
<div class="col-md-4">
<div class="card-group">
    <div class="card">
    <div class="view overlay">
        <img class="card-img-top" src="{{$d->thumbnail}}" alt="Card image cap">
        <a href="#!">
        <div class="mask rgba-white-slight"></div>
        </a>
    </div>
    <div class="card-body">
        <a href="{{ route('dokumentasi.show', $d->id) }}" class="btn_show"><h4 class="card-title text-primary">{{$d->judul}}</h4></a>
        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
    </div>
    <div class="card-footer text-left">
        <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
        
        <i class="fa fa-fw fa-folder-open-o"></i><strong>Kategori</strong>: {{$d->kategori}} &ensp;&ensp;
        <!-- <i class="fa fa-fw fa-file-archive-o"></i><strong>Total</strong>: {{$d->total}}  -->
        
    </div>
    </div>
</div>
</div>
@endforeach