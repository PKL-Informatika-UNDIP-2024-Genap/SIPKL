<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th>Nama Mhs</th>
          <th>NIM</th>
          <th>Tanggal Registrasi</th>
          <th class="action">Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($data_mhs as $mhs)
          <tr>
              <td></td>
              <td>{{ $mhs->nama }}</td>
              <td>{{ $mhs->nim }}</td>
              <td>{{ $mhs->tgl_registrasi }}</td>
              <td>
                <div class="btn btn-primary btn-detail-reg" data-bs-toggle="modal" data-bs-target="#modal-detail-reg"
                data-mhs="{{ $mhs }}">Detail</div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>