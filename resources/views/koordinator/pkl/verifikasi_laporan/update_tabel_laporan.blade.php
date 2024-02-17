<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th>Nama Mhs</th>
          <th>NIM</th>
          <th>Tanggal Kirim Laporan</th>
          <th class="action">Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($data_mhs as $mhs)
          <tr>
              <td></td>
              <td>{{ $mhs->nama }}</td>
              <td>{{ $mhs->nim }}</td>
              <td>{{ $mhs->tgl_laporan }}</td>
              <td>
                <div class="btn btn-sm btn-primary btn-detail-laporan" data-bs-toggle="modal" data-bs-target="#modal-detail-laporan"
                data-mhs="{{ $mhs }}">Detail</div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>