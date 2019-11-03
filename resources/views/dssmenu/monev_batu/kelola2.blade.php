@extends('dssmenu.monev')

@section('content_monev_lingkungan')
<!-- Monev Keterawatan Batu -->
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-success">
        <h4 class="hader-title">Monev Keterawatan Batu</h4>
        </div>
        <div class="card-body">
        {!! Form::model($model,[
            'route' => $model->exists ? ['monev_batu.update', $model->id] : 'monev_batu.store',
        ]) !!}
            <div class="form-group">
                <label for="candi">Pilih Candi</label>
                <select class="form-control" data-style="btn btn-link" name="candi_id" id="candi_id">
                    <option value="">1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal">
            </div>
            <div class="form-group">
                <label for="kategori">Jenis Observasi</label>
                <select class="form-control select2" name="kategori" id="kategori">
                    @foreach($kategori as $k)    
                        <option value="{{$k}}">{{$k}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" id="jumlah">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
        </div>
    </div>
    </div>
</div>
<!-- END -->

<!-- Data tables monev keterawatan batu -->
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-body">
        <div class="row">
            <div class="col-md-3 social-buttons-demo">
                <button class="btn btn-social btn-fill btn-facebook">
                    View
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table  id="datatable" class="table">
            <thead class=" text-primary">
                <th class="th-index">ID</th>
                <th>Candi</th>
                <th>Tanggal</th>
                <th>Observasi</th>
                <th>Hasil</th>
                <th class="th-actions">Action</th>
            </thead>
            <tbody>
                
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- END -->
@endsection

@push('scripts')
<script src="{{ asset('material') }}/js/plugins/jquery.datatables.min.js"></script>
<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('monev_batu.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'candi_id', name: 'cand_id'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'jenis_observasi', name: 'jenis_observasi'},
        {data: 'jumlah', name: 'jumlah'},
        {data: 'action', name: 'action'},
      ]
    });
</script>
@endpush