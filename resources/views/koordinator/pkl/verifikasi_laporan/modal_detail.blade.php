<div class="modal fade" id="modal-detail-laporan" tabindex="-1" data-bs-focus="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Detail Mahasiswa PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="spinner d-none">
          <div class="d-flex align-items-center">
            <div class="spinner-border spinner-border-lg me-2" role="status" aria-hidden="true"></div><div class="fs-5">Mengambil Data Mahasiswa...</div>
          </div>
        </div>
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
                <td class="text-nowrap px-0" style="width: 15%"><strong>Waktu Kirim</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-tgl-laporan"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Pembimbing</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-dospem"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Tanggal Seminar</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-tgl-seminar"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Instansi</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-instansi"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Judul PKL</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-judul-pkl"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Abstrak</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-abstrak" class="collapsed"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Kata Kunci</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td id="data-kata-kunci"></td>
              </tr>
              <tr>
                <td class="text-nowrap px-0" style="width: 15%"><strong>Link Berkas</strong></td>
                <td style="white-space: nowrap; width: 1%">:</td>
                <td>
                  <a id="data-link-laporan" target="__blank" href="//drive.google.com" style="text-decoration: none">
                    <button class="badge text-bg-primary">
                      Tampilkan Laporan
                    </button>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          
          <div class="row justify-content-center d-flex mt-3">
            <div class="col-auto">
              <div class="btn btn-primary btn-sm btn-terima">Terima</div>
              <div class="btn btn-danger btn-sm btn-tolak">Tolak</div>
            </div>
          </div>
          
        </div>
      </div>
      
    </div>
  </div>
</div>

