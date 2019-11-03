<div class="col-12 text-right">
    <a href="{{ route('layanankpk.create',$layanan) }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-success modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
</div>
<div class="col-12">
    <div class="table-responsive">
        <table id="datatable" class="table table-bordered">
        <thead class=" text-primary">
            <th style="width:5%;">ID</th>
            <th>Bulan</th>
            <th>Tanggal</th>
            <th>Tamu</th>
            <th>Instansi</th>
            <th>Alamat</th>
            <th>Keperluan</th>
            @if(($layanan != "laboratorium") && ($layanan != "dokumentasi") && ($layanan != "perpustakaan"))<th>Lokasi</th>@endif
            <th>Jenis Layanan</th>
            <th>Jumlah</th>
            <th class="th-actions">Action</th>
        </thead>
        <tbody>

        </tbody>
        </table>
    </div>
</div>
@if(($layanan != "laboratorium") && ($layanan != "dokumentasi") && ($layanan != "perpustakaan") )
<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('layanankpk.table',$layanan) }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'month', name: 'month'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'tamu', name: 'tamu'},
        {data: 'instansi', name: 'instansi'},
        {data: 'alamat', name: 'alamat'},
        {data: 'keperluan', name: 'keperluan'},
        {data: 'lokasi', name: 'lokasi'},
        {data: 'jenis_layanan', name: 'jenis_layanan'},
        {data: 'jumlah', name: 'jumlah'},
        {data: 'action', name: 'action'},
      ],
      orderFixed: [[2,'desc']],
      rowGroup: {
        dataSrc: ['month','jenis_layanan']
      },
      columnDefs: [{
        targets: [1,4,8],
        visible: false
      },
      {
        orderable: false, targets: [10]
      }]
    });
</script>
@else
<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('layanankpk.table',$layanan) }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'month', name: 'month'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'tamu', name: 'tamu'},
        {data: 'instansi', name: 'instansi'},
        {data: 'alamat', name: 'alamat'},
        {data: 'keperluan', name: 'keperluan'},
        {data: 'jenis_layanan', name: 'jenis_layanan'},
        {data: 'jumlah', name: 'jumlah'},
        {data: 'action', name: 'action'},
      ],
      orderFixed: [[2,'desc']],
      rowGroup: {
        dataSrc: ['month','jenis_layanan']
      },
      columnDefs: [{
        targets: [1,4,7],
        visible: false
      },
      {
        orderable: false, targets: [9]
      }]
    });
</script>
@endif