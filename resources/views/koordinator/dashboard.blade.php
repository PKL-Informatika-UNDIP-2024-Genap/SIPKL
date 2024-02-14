@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-6 col-12">
        <!-- small card -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $periode_aktif ? $periode_aktif->id_periode : "-" }}</h3>

            <h4>Periode Aktif</h4>
          </div>
          <div class="icon">
            <i class="fas bi bi-calendar-check"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-6 col-12">
        <!-- small card -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $periode_mendatang ? $periode_mendatang->id_periode : "-" }}</h3>

            <h4>Periode Mendatang</h4>
          </div>
          <div class="icon">
            <i class="fas bi bi-calendar-range"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <h5>Rekap Periode Saat Ini</h5>
      </div>
    </div>
@auth
    
@endauth
    <div class="row">
      <div class="col-3">
        <!-- small card -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ isset($data_mhs["Lulus"]) ? $data_mhs["Lulus"] : "0" }}</h3>

            <p>Mhs Lulus</p>
          </div>
          <div class="icon">
            <i class="fas bi bi-mortarboard-fill"></i>
          </div>
        </div>
      </div>
      <div class="col-3">
        <!-- small card -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{ isset($data_mhs["Aktif"]) ? $data_mhs["Aktif"] : "0" }}</h3>

            <p>Mhs Aktif</p>
          </div>
          <div class="icon">
            <i class="fas bi bi-person-fill-check"></i>
          </div>
        </div>
      </div>
      <div class="col-3">
        <!-- small card -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3 class="text-white">{{ isset($data_mhs["Nonaktif"]) ? $data_mhs["Nonaktif"] : "0" }}</h3>

            <p class="text-white">Mhs Belum Reg</p>
          </div>
          <div class="icon">
            <i class="fas bi-person-fill-dash"></i>
          </div>
        </div>
      </div>
      <div class="col-3">
        <!-- small card -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ isset($data_mhs["Baru"]) ? $data_mhs["Baru"] : "0" }}</h3>

            <p>Mhs Belum Pra-Reg</p>
          </div>
          <div class="icon">
            <i class="fas bi-person-fill-exclamation"></i>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-6">
        <!-- small card -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{ $total_mhs }}</h3>

            <p>Total Mahasiswa</p>
          </div>
          <div class="icon">
            <i class="fas bi bi-people-fill"></i>
          </div>
        </div>
      </div>
      <div class="col-6">
        <!-- small card -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{ $total_dospem ? $total_dospem : "0" }}</h3>

            <p>Total Dospem</p>
          </div>
          <div class="icon">
            <i class="fas bi bi-person-vcard-fill"></i>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection
