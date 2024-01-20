<div class="modal fade" id="modal_edit_dokumen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Edit Dokumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-edit-dokumen" action="" method="post">
          @csrf
          @method("PUT")
          <div class="row">
            <div class="mb-3">
              <input type="hidden" id="id">
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <input type="text" class="form-control" id="deskripsi-edit" name="deskripsi">
              <div id="deskripsi-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="lampiran" class="form-label">Lampiran</label>
              <input type="text" class="form-control" id="lampiran-edit" name="lampiran">
              <div id="lampiran-edit-err" class="invalid-feedback"></div>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button id="update-dokumen" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

