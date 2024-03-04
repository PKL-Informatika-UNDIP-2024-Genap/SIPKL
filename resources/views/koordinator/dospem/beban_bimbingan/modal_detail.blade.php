<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Beban Bimbingan Pembimbing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col" style="max-width: 150px">Nama</div>
          <div class="col-auto">:</div>
          <div class="col-auto" id="data-nama"></div>
        </div>
        <div class="row">
          <div class="col" style="max-width: 150px">NIP</div>
          <div class="col-auto">:</div>
          <div class="col-auto" id="data-nip"></div>
        </div>
        <div class="row">
          <div class="col" style="max-width: 150px">Jumlah Bimbingan</div>
          <div class="col-auto">:</div>
          <div class="col-auto" id="data-jml-bimbingan"></div>
        </div>
        <div class="row mb-3">
          <div class="col" style="max-width: 150px">Periode PKL</div>
          <div class="col-auto" >:</div>
          <div class="col-auto" id="data-periode-pkl">
            <select name="periode-pkl-modal" id="periode-pkl-modal" style="cursor: pointer; border-color:lightgray; border-radius: 5px">
              <option value="">Semua</option>
              <option value="belum">Belum Memiliki Periode</option>
              @foreach ($arr_periode as $periode)
                <option value="{{ $periode }}">{{ $periode }}</option>
              @endforeach
            </select>
          </div>
        </div>

        
        <div class="row">
          <div class="col table-responsive" id="tabel-modal">
            
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

