@extends('layouts.main_mhs')

@section('container')
	<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
			<div class="row mb-2">
        <div class="col">
          <h1 class="m-0">Arsip PKL</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
		</div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content" id="main-content">
    <div class="container-fluid">
      <div class="row">
				<div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">

              <div class="row">
                <div class="col d-flex align-items-center justify-content-between gap-1">
                  <strong class="text-lightblue my-3">Arsip PKL Saya</strong>
                  {{--  --}}
                </div>
              </div>
							
              <div class="table-responsive p-0 mb-3">
                <table class="table table-hover">
                  <tbody>
										<tr>
                      <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong class="text-warning">Tidak tersedia karena belum menerima nilai</strong></td>
										</tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
    
            </div>
          </div>
          <!-- /.card -->

        </div>
			</div>
			<!-- /.row -->


		</div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection