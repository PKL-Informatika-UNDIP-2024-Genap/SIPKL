@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Mahasiswa Belum Lulus Periode Saat Ini</h1>
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

    <div class="card px-3">
      <div class="card-body px-0">

        <div class="row mb-3">
          <div class="col-auto">
            <button class="btn btn-primary btn-sm {{ count($arr_mhs) ? "" : "disabled" }}" id="reset-status" data-arr-nim="{{ json_encode($arr_nim) }}">
              Reset Status Mahasiswa
            </button>
          </div>
        </div>

        <div id="tabel-belum-lulus" class="table-responsive">
          <table class="table" id="myTable">
            <thead>
                <tr class="table-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Status</th>
                  <th>Dospem</th>
                  <th class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arr_mhs as $mhs)
                  <tr>
                    <td></td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->status }}</td>
                    <td>{{ $mhs->nama_dospem ? $mhs->nama_dospem : "-" }}</td>
                    <td>
                      <div class="btn btn-primary btn-sm btn-detail-mhs" data-bs-toggle="modal" data-bs-target="#modal-detail-mhs" data-mhs="{{ $mhs }}"
                      >
                        Detail
                      </div>
                      <button class="btn btn-success btn-sm btn-wa" data-nim="{{ $mhs->nim }}" {{ $mhs->no_wa ? "" : "disabled" }}>
                        <a href="//wa.me/{{ $mhs->no_wa }}" target="__blank" style="text-decoration: none; color: white">
                          Hubungi Mhs
                        </a>
                      </button>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@include('koordinator.mhs.belum_lulus.modal_detail')

@endsection

@push('scripts')
<script src="/js/ajax-mhs-blm-lulus.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = simpleDatatable();
</script>
@endpush