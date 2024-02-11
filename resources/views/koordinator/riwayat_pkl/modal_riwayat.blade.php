      {{-- <div class="modal-body">
        <div class="spinner d-none">
          <div class="d-flex align-items-center">
            <div class="spinner-border spinner-border-lg me-2" role="status" aria-hidden="true"></div><div class="fs-5">Mengambil Data Mahasiswa...</div>
          </div>
        </div>
        <div class="content-modal">
          <div class="row mt-3">
            <div class="col">
              <p class="p-0 m-0" style="font-weight: bold">Data PKL</p>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              Status
            </div>
            <div class="col-auto" id="data-status">
              :
            </div>
          </div>
        </div>
      </div> --}}
      
<div class="modal fade" id="modal_detail_mhs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Detail Riwayat PKL Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-auto">
            <div class="row">
              <div class="col" style="max-width: 50px">Nama</div>
              <div class="col-auto" id="data-nama"></div>
            </div>
            <div class="row mb-3">
              <div class="col" style="max-width: 50px">NIM</div>
              <div class="col-auto" id="data-nim"></div>
            </div>
          </div>
          <div class="col-auto ms-auto mt-auto">
            <button type="button" class="btn btn-primary mb-2" id="btn-edit">Export</button>
            <button type="button" class="btn btn-danger mb-2 d-none" id="btn-cancel">Cancel</button>
          </div>
        </div>
        
        <div class="row">
          <div class="col" id="tabel-modal">
            
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

