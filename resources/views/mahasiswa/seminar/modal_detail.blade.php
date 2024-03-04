<div class="modal fade" id="modal-detail-jadwal" tabindex="-1" data-bs-focus="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Detail Seminar Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="content-modal mt-0">
          <table class="table table-hover">
            <tbody>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%; border-top:none"><strong>Nama</strong></td>
                <td style="white-space: nowrap; width: 1%; border-top:none">:</td>
                <td id="data-nama" style="border-top: none"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>NIM</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-nim"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Pembimbing</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-dospem"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Tanggal Seminar</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td class="p-0 m-0">
                  <div id="data-tgl-seminar" style="padding: 0.75rem"></div>

                </td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Waktu Seminar</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td class="p-0 m-0">
                  <div id="data-waktu-seminar" style="padding: 0.75rem"></div>

                </td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Ruang</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td class="p-0 m-0">
                  <div id="data-ruang" style="padding: 0.75rem"></div>

                </td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Jenis Seminar</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-jenis-seminar"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Instansi</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-instansi"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Judul PKL</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-judul"></td>
              </tr>
            </tbody>
          </table>

          {{-- <div class="row justify-content-center d-flex mt-3">
            <div class="col-auto">
              <div id="btn-edit" class="btn btn-primary btn-sm">Edit</div>
              <div id="btn-batal" class="btn btn-danger btn-sm d-none">Batal</div>
            </div>
          </div> --}}
        </div>
      </div>
      
    </div>
  </div>
</div>

