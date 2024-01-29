<div class="modal fade" id="modal_edit_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Edit Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-edit-password" action="" method="post">
          @csrf
          @method("put")
          {{-- <div class="row"> --}}
            <div class="form-group">
              <label for="password_lama" class="form-label">Password Lama</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                </div>
                <input type="password" class="form-control" id="passwordlama-edit" name="password_lama">
              </div>
              <div id="passwordlama-edit-err" class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="password_baru" class="form-label">Password Baru</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                <input type="password" class="form-control" id="passwordbaru-edit" name="password_baru">
              </div>
              <div id="passwordbaru-edit-err" class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="konfirmasi_password_baru" class="form-label">Konfirmasi Password Baru</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                <input type="password" class="form-control" id="konfirmasipasswordbaru-edit" name="konfirmasi_password_baru">
              </div>
              <div id="konfirmasipasswordbaru-edit-err" class="invalid-feedback d-block"></div>
            </div>
          {{-- </div> --}}
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button id="update-password" class="btn btn-primary">Update Password</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
