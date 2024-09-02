@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Assign Pembimbing Mahasiswa PKL</h1>
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
            <div id="tabel-mhs" class="table-responsive pt-1">
              <table class="table" id="myTable2" style="width: 100%">
                <thead>
                  <tr class="table-primary">
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIM</th>
                      <th>Pembimbing</th>
                      <th class="judul-pkl">Judul PKL</th>
                      <th class="instansi-pkl">Instansi</th>
                      <th class="action">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_mhs as $mhs)
                    <tr data-nim="{{ $mhs->nim }}" data-instansi="{{ $mhs->instansi }}" data-judul="{{ $mhs->judul }}">
                      <td></td>
                      <td class="details-control">{{ $mhs->nama }}</td>
                      <td>{{ $mhs->nim }}</td>
                      <td class="kolom-nama-dospem">{{ $mhs->nama_dospem ?? "-"}}</td>
                      <td class="judul-pkl">{{ $mhs->judul }}</td>
                      <td class="instansi-pkl">{{ $mhs->instansi }}</td>
                      <td>
                        <div class="btn btn-primary btn-sm btn-assign-dospem" data-bs-toggle="modal" data-bs-target="#modal-assign-dospem"
                          data-nim="{{ $mhs->nim }}" data-id-dospem="{{ $mhs->id_dospem }}">
                          Assign Pembimbing
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

@include('koordinator.mhs.assign_dospem.modal_assign_dospem')

@endsection

@push('styles')
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/plugins/select2-bootstrap5-theme/select2-bootstrap5.min.css">
@endpush

@push('scripts')
<script src="/js/ajax-assign-dospem.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush