<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Edit Data PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-edit-data" action="" method="post">
          @csrf
          @method("put")
          <div class="form-group">
            <label for="instansi" class="form-label">Instansi</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-building-fill"></i></span>
              <input type="text" class="form-control" id="instansi-edit" name="instansi" placeholder="Masukkan nama Instansi">
            </div>
            <div id="instansi-edit-err" class="invalid-feedback d-block"></div>
          </div>
          <div class="form-group">
            <label for="judul" class="form-label">Judul</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-fonts"></i></span>
              <input type="text" class="form-control" id="judul-edit" name="judul" placeholder="Masukkan judul PKL">
            </div>
            <div id="judul-edit-err" class="invalid-feedback d-block"></div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button id="update-data" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
