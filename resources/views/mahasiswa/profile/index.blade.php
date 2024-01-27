@extends('layouts.main_mhs')

@push('styles')
  {{-- <style>
    tr td{
      padding-left: 0 !important;
      padding-right: 0 !important;
    }
  </style> --}}
@endpush

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Profil Saya</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Profile Image -->
      <div class="card card-primary card-outline col-xl-6">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
              src="{{ (auth()->user()->foto_profil == null)?'/images/default.jpg':auth()->user()->foto_profil }}"
              alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{ $mahasiswa->nama }}</h3>
          <p class="text-muted text-center">{{ $mahasiswa->nim }}</p>

          {{-- <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>No WA</b> <span class="float-right">{{ $mahasiswa->no_wa }}</span>
            </li>
            <li class="list-group-item">
              <b>Email</b> <span class="float-right">{{ $mahasiswa->email }}</span>
            </li>
            <li class="list-group-item">
              <b>Status</b> <span class="float-right">{{ $mahasiswa->status }}</span>
            </li>
          </ul> --}}
          <div class="table-responsive p-0 mb-3">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td class="text-nowrap px-0"><strong>Status</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td><strong class="{{ ($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus')?'bg-success':'bg-danger' }} p-2 rounded-2">{{ $mahasiswa->status }}</strong></td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0"><strong>Periode PKL</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->periode_pkl }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0"><strong>No WA</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->no_wa }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0"><strong>Email</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->email }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
          <strong class="text-lightblue">Dosen Pembimbing</strong>
          <p></p>
          <div class="table-responsive p-0 mb-3">
            <table class="table table-hover">
              <tbody>

                @if ($mahasiswa->nip_dospem == null)
                <tr>
                  <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong>Belum ada</strong></td>
                </tr>
                @else
                <tr>
                  <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>NIP</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->nip_dospem }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>Nama</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->nama_dospem }} </td>
                </tr>
                @endif

              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->


          <a href="/profile/edit" class="btn btn-primary"><b>Edit Profil</b></a>
          <a href="/profile/edit_password" class="btn btn-primary"><b>Edit Password</b></a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection
