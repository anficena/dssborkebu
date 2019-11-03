<table class="table table-bordered count">
    <tr>
        <td>No</td>
        <td>Judul</td>
        <td>Penulis</td>
        <td>Tanggal</td>
        <td>Detail</td>
    </tr>
    @foreach($model as $key => $m)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$m->judul}}</td>
        <td>{{$m->penulis}}</td>
        <td>{{$m->tanggal}}</td>
        <td><a href="{{route('kajian.show',$m->id)}}" class="modal-show">Preview</a></td>
    </tr>
    @endforeach
</table>


<style>
.count{
    font-size: 11pt;
}
</style>

        
