@extends('layouts.main_mhs')

@push('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('container')
	<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h1 class="m-0">Riwayat PKL</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive pt-1">
                <table class="table" id="myTable">
                  <thead>
                      <tr class="table-primary">
                          <th>No</th>
                          <th>Periode</th>
                          <th>Status</th>
                          <th>Dosen Pembimbing</th>
                          <th>NIP Dosen Pembimbing</th>
                      </tr>
                  </thead>
                  <tbody>
                    @if ($data_riwayat_pkl)
                      @foreach ($data_riwayat_pkl as $index => $riwayat_pkl)
                          <tr>
                              <td>{{ $index+1 }}</td>
                              <td>{{ $riwayat_pkl->periode_pkl }}</td>
                              <td>{{ $riwayat_pkl->status }}</td>
                              <td>{{ $riwayat_pkl->dosen_pembimbing->nama }}</td>
                              <td>{{ $riwayat_pkl->dosen_pembimbing->nip }}</td>
                          </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

@push('scripts')
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
      $('#myTable').DataTable();
    });
  </script>

@endpush