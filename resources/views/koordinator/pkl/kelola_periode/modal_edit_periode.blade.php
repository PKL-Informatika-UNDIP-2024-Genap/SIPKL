<div class="modal fade" id="modal-edit-periode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Edit Periode PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <form id="form-add" action="" method="post">
            @csrf
            <div class="mb-3">
              <label for="id-periode-edit" class="form-label">Periode</label>
              <input type="text" class="form-control" id="id-periode-edit" name="id-periode-edit" placeholder="20xx/20xx Ganjil">
              <div id="id-periode-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="">
              <label for="tgl-mulai-edit" class="form-label">Tanggal Mulai</label>
              <input id="tgl-mulai-edit" class="form-control" type="date" style="max-width: 170px" name="tgl-mulai-edit"/>
              <div id="tgl-mulai-edit-err" class="invalid-feedback"></div>
            </div>
            <div class="">
              <label for="tgl-selesai-edit" class="form-label mt-3">Tanggal Selesai</label>
              <input id="tgl-selesai-edit" class="form-control" type="date" style="max-width: 170px" name="tgl-selesai-edit"/>
              <div id="tgl-selesai-edit-err" class="invalid-feedback"></div>
            </div>
          </form>
        </div>
        <div class="row d-flex justify-content-center mt-3">
          <div class="col-auto">
            <button id="update" class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

