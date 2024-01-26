<div class="modal fade" id="modal_edit_mhs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Edit Mahasiswa PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-edit-mhs" action="" method="post">
          @csrf
          @method("PUT")
          <div class="row">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama-edit" name="nama">
              <div id="nama-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim-edit" name="nim" disabled>
              <div id="nim-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select name="status" class="form-control" id="status-edit">
                <option value="" disabled selected>Pilih Status</option>
                <option value="Baru">Baru</option>
                <option value="Nonaktif">Nonaktif</option>
                <option value="Aktif">Aktif</option>
              </select>
              <div id="status-edit-err" class="invalid-feedback"></div>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button id="update-mhs" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

