@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Assign Mahasiswa Bimbingan</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div id="tabel-dospem" class="table-responsive pt-1">
              <table class="table" id="myTable">
                <thead>
                  <tr class="table-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jumlah Bimbingan</th>
                    <th class="action">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_dospem as $index => $dospem)
                    <tr>
                      <td></td>
                      <td>{{ $dospem->nama }}</td>
                      <td>{{ $dospem->nip }}</td>
                      <td>{{ $dospem->jumlah_bimbingan ?? 0 }}</td>
                      <td>
                          <div class="btn btn-sm btn-primary btn-assign-mhs" data-nama="{{ $dospem->nama }}" data-nip="{{ $dospem->nip }}" data-id="{{ $dospem->id }}" data-bs-toggle="modal" data-bs-target="#modal_assign_mhs">
                            Assign Mahasiswa
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
  </div>
</section>

@include('koordinator.dospem.assign_mhs_bimbingan.modal_assign_mhs')
@endsection

@push('scripts')
<script src="/js/datatables-jquery.js"></script>
<script src="/js/ajax-assign-mhs.js"></script>
<script>
  simpleDatatable();
</script>
@endpush