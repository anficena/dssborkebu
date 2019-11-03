<div class="col-12 text-right">
    <a href="{{ route('layanan_temuan.create') }}" title="Tambah Data" data-target="#modal" class="btn btn-outline-success modal-show"><i class="material-icons">add</i>Tambah Data<div class="ripple-container"></div></a>
</div>
<div class="col-12">
    <div class="table-responsive">
        <table id="datatable" class="table table-bordered">
        <thead class=" text-primary">
            <th style="width:5%;">ID</th>
            <th>Bulan</th>
            <th>Tanggal</th>
            <th>Temuan</th>
            <th>Penemu</th>
            <th>Alamat</th>
            <th>Deskripsi</th>
            <th>kompensasi</th>
            <th class="th-actions">Action</th>
        </thead>
        <tbody>

        </tbody>
        </table>
    </div>
</div>
<script>
   $('#datatable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax:"{{ route('layanan_temuan.table') }}",
      columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'month', name: 'month'},
        {data: 'tanggal', name: 'tanggal'},
        {data: 'jenis_temuan', name: 'jenis_temuan'},
        {data: 'penemu', name: 'penemu'},
        {data: 'alamat', name: 'alamat'},
        {data: 'bentuk', name: 'bentuk'},
        {data: 'kompensasi', name: 'kompensasi'},
        {data: 'action', name: 'action'},
      ],
      orderFixed: [[2,'desc']],
      rowGroup: {
        dataSrc: ['month']
      },
      columnDefs: [{
        targets: [1],
        visible: false
      },
      {
        orderable: false, targets: [8]
      }]
    });
</script>