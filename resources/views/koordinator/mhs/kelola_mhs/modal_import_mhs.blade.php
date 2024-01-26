<div class="modal fade" id="modal_import_mhs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Import Mahasiswa PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-import" action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row mb-2 justify-content-between">
            <div class="col-auto">
              <p class="m-0">File yang didukung: .xls, .xlsx</p>
            </div>
            <div class="col-auto">
              <a href="/download_file/private/template/template-import-mhs.xlsx">Download Template</a>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <input class="form-control" type="file" name="file" id="file">
              <div id="file-err" class="invalid-feedback"></div>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button class="btn btn-primary" type="button" id="btn-import-mhs">Import</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

