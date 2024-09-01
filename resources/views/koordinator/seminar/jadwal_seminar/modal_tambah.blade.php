<div class="modal fade" id="modal-tambah-jadwal" tabindex="-1" data-bs-focus="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Tambah Jadwal Seminar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="spinner d-none">
          <div class="d-flex align-items-center">
            <div class="spinner-border spinner-border-lg me-2" role="status" aria-hidden="true"></div><div class="fs-5">Mengambil Data Mahasiswa...</div>
          </div>
        </div>
        <div class="content-modal mt-0">
          <div class="row mb-3">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
              <div class="row">
                <div class="col-auto">
                  <label for="input-tgl-seminar" class="col-form-label">Tanggal Seminar</label>
                  <input id="input-tgl-seminar" type="date" class="form-control my-1" style="width: 150px">
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-4 me-4">
              <div class="row">
                <div class="col-auto">
                  <label for="input-waktu-mulai" class="col-form-label">Waktu Seminar</label>
                </div>
              </div>
              <div class="row">
                <div class="col-auto">
                  <input id="input-waktu-mulai" type="time" class="form-control my-1" style="width: 100px">
                </div>
                <div class="col-auto">
                  <h2>-</h2>
                </div>
                <div class="col-auto">
                  <input id="input-waktu-selesai" type="time" class="form-control my-1" style="width: 100px">
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
              <div class="row">
                <div class="col-auto">
                  <label for="input-ruang" class="col-form-label">Ruang Seminar</label>
                  <input id="input-ruang" type="text" class="form-control my-1" style="width: 150px">
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col">
              <label for="">Pilih Mahasiswa</label>
            </div>
          </div>
          <div class="row">
            <div class="col table-responsive" id="container-tabel-modal">

            </div>
          </div>

          <div class="row justify-content-center d-flex mt-3">
            <div class="col-auto">
              <div id="btn-submit" class="btn btn-primary btn-sm">Submit</div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

