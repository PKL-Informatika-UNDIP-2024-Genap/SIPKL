@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Kelola Periode PKL</h1>
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
              <div class="col-auto mb-2 d-flex align-items-center">
                {{-- <strong class="mr-3 text-lightblue">Action:</strong> --}}
                <button type="button" id="btn-add" class="btn btn-sm btn-primary btn-add" data-periode="{{ isset($data_periode[0]) ? $data_periode[0] : '' }}"  
                  data-bs-toggle="modal" data-bs-target="#modal-add-periode">
                  + Tambah Periode PKL
                </button>
              </div>
            </div>
            <div id="tabel-periode" class="table-responsive pt-1">
              <table class="table" id="myTable">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Periode</th>
                        <th class="tanggal">Tanggal Mulai</th>
                        <th class="tanggal">Tanggal Selesai</th>
                        <th>Status</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_periode as $periode)
                        <tr>
                            <td></td>
                            <td>{{ $periode->id_periode }}</td>
                            <td>{{ $periode->tgl_mulai }}</td>
                            <td>{{ $periode->tgl_selesai }}</td>
                            <td>
                              @if (date('Y-m-d') >= $periode->tgl_mulai && date('Y-m-d') <= $periode->tgl_selesai)
                                <span class="badge bg-primary">Aktif</span>
                              @elseif($periode->tgl_selesai < date('Y-m-d'))
                                <span class="badge bg-success">Selesai</span>
                              @else
                                <span class="badge bg-secondary">Mendatang</span>
                              @endif
                            </td>
                            <td>
                                <div class="btn btn-sm btn-info btn-edit-periode" data-bs-toggle="modal" data-bs-target="#modal-edit-periode" 
                                data-prev-periode="{{isset($data_periode[$loop->index + 1]) ? $data_periode[$loop->index + 1] : ""}}" data-periode="{{ $periode }}">Edit</div>
                                <div class="btn btn-sm btn-danger btn-delete-periode {{ date('Y-m-d') > $periode->tgl_selesai ? 'disabled' : '' }}" data-id-periode="{{ $periode->id_periode }}">
                                  Delete
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

{{-- modal add periode --}}
@include('koordinator.pkl.kelola_periode.modal_add_periode')
{{-- end modal add periode --}}

{{-- modal edit periode --}}
@include('koordinator.pkl.kelola_periode.modal_edit_periode')
{{-- end modal edit periode --}}

@endsection

{{-- @push('styles')
@endpush --}}

@push('scripts')
<!-- InputMask -->
<script src="/lte/plugins/moment/moment.min.js"></script>
<script src="/lte/plugins/moment/locale/id.js"></script>

<script src="/js/ajax-kelola-periode.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = simpleDatatable();
  tabel.order([1, 'desc']).draw();
</script>
@endpush