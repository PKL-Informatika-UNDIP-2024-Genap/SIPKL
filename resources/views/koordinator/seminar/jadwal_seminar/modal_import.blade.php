<div class="modal fade" id="modal-import-jadwal" tabindex="-1" data-bs-focus="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Import Jadwal Seminar Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-2 justify-content-between ">
          <div class="col-auto">
            <p class="m-0">File yang didukung: .xls, .xlsx</p>
          </div>
          <div class="col-auto">
            <a href="/seminar/jadwal_seminar/export_mhs_aktif" target="blank">Excel Daftar Mhs Aktif</a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <form action="" method="post" enctype="multipart/form-data" id="form-import">
              <input type="file" name="file" id="file">
              <div id="file-err" class="invalid-feedback"></div>
            </form>
          </div>
        </div>

        <div class="row justify-content-center d-flex mt-3">
          <div class="col-auto">
            <button id="btn-submit-import" class="btn btn-primary">Import</button>
          </div>
        </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

