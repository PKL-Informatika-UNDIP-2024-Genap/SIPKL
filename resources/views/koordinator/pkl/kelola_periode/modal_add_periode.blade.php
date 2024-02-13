<div class="modal fade" id="modal-add-periode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Tambah Periode PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <form id="form-add" action="" method="post">
            @csrf
            <div class="mb-3">
              <label for="id-periode" class="form-label">Periode</label>
              <input type="text" class="form-control" id="id-periode" name="id-periode" placeholder="20xx/20xx Ganjil">
              <div id="id-periode-err" class="invalid-feedback"></div>
            </div>
            <div class="">
              <label for="tgl-mulai" class="form-label">Tanggal Mulai</label>
              <input id="tgl-mulai" class="form-control" type="date" style="max-width: 170px" name="tgl-mulai"/>
              <div id="tgl-mulai-err" class="invalid-feedback"></div>
            </div>
            <div class="">
              <label for="tgl-selesai" class="form-label mt-3">Tanggal Selesai</label>
              <input id="tgl-selesai" class="form-control" type="date" style="max-width: 170px" name="tgl-selesai"/>
              <div id="tgl-selesai-err" class="invalid-feedback"></div>
            </div>
          </form>
        </div>
        <div class="row d-flex justify-content-center mt-3">
          <div class="col-auto">
            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

