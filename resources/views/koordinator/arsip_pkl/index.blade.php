@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Mahasiswa PKL</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-auto mb-2 d-flex align-items-center gap-1">
                <button type="button" id="btn-export" class="btn btn-sm btn-success">
                  <span class="bi bi-upload me-1"></span>
                  Export Nilai
                </button>
              </div>
              <div class="col-auto mb-2 d-flex align-items-center mx-auto mr-md-0">
                <label for="periode-pkl" class="my-0 mr-2 fw-normal">Periode PKL:</label>
                <div class="d-inline-block" style="width: 200px">
                  <select name="periode-pkl" id="periode-pkl" class="form-control">
                    <option value="" selected>Semua Periode</option>
                    @foreach ($arr_periode as $periode)
                      <option value="{{ $periode }}">{{ $periode }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div id="tabel-arsip" class="table-responsive pt-1">
              <div data-arsip="{{ $arr_arsip }}" id="data-arsip"></div>
              <table class="table" id="myTable">
                <thead>
                  <tr class="table-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Periode PKL</th>
                    <th>Nilai</th>
                    <th class="action">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($arr_arsip as $arsip)
                    <tr>
                      <td></td>
                      <td>{{ $arsip->nama }}</td>
                      <td>{{ $arsip->nim }}</td>
                      <td>{{ $arsip->periode_pkl }}</td>
                      <td>
                        @if ($arsip->nilai == "A")
                          <h4><span class="badge bg-success">A</span></h4>
                        @elseif($arsip->nilai == "B")
                          <h4><span class="badge bg-primary">B</span></h4>
                        @else
                          <h4><span class="badge bg-warning">C</span></h4>
                        @endif
                      </td>
                      <td class="py-0 align-middle">
                        <div class="btn btn-primary btn-detail btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detail" data-arsip="{{ $arsip }}">
                          Detail
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@include('koordinator.arsip_pkl.modal_detail')

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/plugins/select2-bootstrap5-theme/select2-bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="/js/ajax-arsip-pkl.js"></script>
<!-- JS DataTables Button -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = datatableWithCustomFilter("#periode-pkl", 3);
  tabel.order([[1, 'asc'],[3, 'desc'],[4, 'asc']]).draw();
  
  $('#btn-export').on('click', function () {
    tabel.button(0).trigger();
  })

  $('#periode-pkl').select2({
			theme: 'bootstrap-5',
			// allowClear: true,
			minimumResultsForSearch: Infinity,
			// placeholder: 'Semua',
			// width: '100%',
		});
</script>
@endpush