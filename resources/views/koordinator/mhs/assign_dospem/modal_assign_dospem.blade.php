<div class="modal fade" id="modal-assign-dospem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Assign Dosen Pembimbing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="mb-3">
              <form id="form-assign-dospem" action="" method="post">
                @csrf
              <label for="dosen-pembimbing" class="form-label">Dosen Pembimbing</label>
              <select name="dosen-pembimbing" class="form-control select2bs4" style="width: 100%;" id="dosen-pembimbing">
                <option value="" disabled selected>Pilih Dospem</option>
                @foreach ($data_dospem as $dospem)
                  <option value="{{ $dospem->id }}">{{ $dospem->nama }}</option>
                @endforeach
              </select>
              <div id="dosen-pembimbing-err" class="invalid-feedback"></div>
            </form>
          </div>            
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-auto">
            <button id="simpan-dospem" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
