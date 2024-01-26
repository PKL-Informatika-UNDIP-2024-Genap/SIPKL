<div class="modal fade" id="modal_edit_dospem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Edit Dosen Pembimbing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-edit-dospem" action="" method="post">
          @csrf
          @method("PUT")
          <div class="row">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama-edit" name="nama">
              <div id="nama-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="nip" class="form-label">NIP</label>
              <input type="text" class="form-control" id="nip-edit" name="nip" disabled>
              <div id="nip-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="golongan" class="form-label">Golongan</label>
              <select name="golongan" class="form-control" id="golongan-edit">
                <option value="" disabled selected>Pilih Golongan</option>
                <option value="III/a">III/a</option>
                <option value="III/b">III/b</option>
                <option value="III/c">III/c</option>
                <option value="III/d">III/d</option>
                <option value="IV/a">IV/a</option>
                <option value="IV/b">IV/b</option>
                <option value="IV/c">IV/c</option>
                <option value="IV/d">IV/d</option>
                <option value="IV/e">IV/e</option>
              </select>
              <div id="golongan-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="jabatan" class="form-label">Jabatan</label>
              <select name="jabatan" class="form-control" id="jabatan-edit">
                <option value="" disabled selected>Pilih Jabatan</option>
                <option value="Pengajar">Pengajar</option>
                <option value="Asisten Ahli">Asisten Ahli</option>
                <option value="Lektor">Lektor</option>
                <option value="Lektor Kepala">Lektor Kepala</option>
                <option value="Guru Besar">Guru Besar</option>
              </select>
              <div id="jabatan-edit-err" class="invalid-feedback"></div>
            </div>
            
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button id="update-dospem" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

