@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Beban Bimbingan Dospem</h1>
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
            <div class="row mb-2 align-items-center justify-content-center">
              <div class="col-auto">
                <p class="m-0 p-0"><strong>Pilih Periode :</strong></p>
              </div>
              <div class="col" style="max-width: 250px">
                <select name="periode-pkl" id="periode-pkl" class="form-select" style="cursor: pointer;">
                  <option value="" selected>Semua</option>
                  <option value="belum">Belum Memiliki Periode</option>
                  @foreach ($arr_periode as $periode)
                  <option value="{{ $periode }}">{{ $periode }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div id="tabel-index" class="table-responsive pt-1">
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
                  @foreach ($arr_dospem as $dospem)
                    <tr>
                      <td></td>
                      <td>{{ $dospem->nama }}</td>
                      <td>{{ $dospem->nip }}</td>
                      <td>{{ $dospem->jml_bimbingan }}</td>
                      <td>
                        <div class="btn btn-sm btn-primary btn-detail" data-dospem="{{ $dospem }}" data-bs-toggle="modal" data-bs-target="#modal-detail">
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

@include('koordinator.dospem.beban_bimbingan.modal_detail')

@endsection

@push('scripts')
<script src="/js/ajax-beban-bimbingan.js"></script>

<script src="/js/datatables-jquery.js"></script>
<script>
  simpleDatatable();
</script>
@endpush