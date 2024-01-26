<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Tambah Dosen Pembimbing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-add" action="" method="post">
          @csrf
          <div class="row">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama">
              <div id="nama-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="nip" class="form-label">NIP</label>
              <input type="text" class="form-control" id="nip" name="nip">
              <div id="nip-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="golongan" class="form-label">Golongan</label>
              <select name="golongan" class="form-control" id="golongan">
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
              <div id="golongan-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="jabatan" class="form-label">Jabatan</label>
              <select name="jabatan" class="form-control" id="jabatan">
                <option value="" disabled selected>Pilih Jabatan</option>
                <option value="Pengajar">Pengajar</option>
                <option value="Asisten Ahli">Asisten Ahli</option>
                <option value="Lektor">Lektor</option>
                <option value="Lektor Kepala">Lektor Kepala</option>
                <option value="Guru Besar">Guru Besar</option>
              </select>
              <div id="jabatan-err" class="invalid-feedback"></div>
            </div>
            
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

