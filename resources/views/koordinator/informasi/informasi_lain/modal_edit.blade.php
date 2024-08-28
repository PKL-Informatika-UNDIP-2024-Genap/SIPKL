<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Edit Informasi</h5>
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
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama-edit" name="nama" disabled>
              <div id="nama-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="value" class="form-label">Value</label>
              <textarea class="form-control" id="value-edit" name="value"></textarea>
              <div id="value-edit-err" class="invalid-feedback"></div>
            </div>
          </div>
        </form>
        <div class="row d-flex justify-content-center">
          <div class="col-auto">
            <button id="update-informasi" class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

