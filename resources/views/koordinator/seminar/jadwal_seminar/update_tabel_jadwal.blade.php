<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th>Nama</th>
          <th>NIM</th>
          <th>Tanggal Seminar</th>
          <th>Waktu</th>
          <th>Jenis</th>
          <th class="action">Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($data_jadwal as $jadwal)
          <tr>
              <td></td>
              <td>{{ $jadwal->mahasiswa->nama }}</td>
              <td>{{ $jadwal->nim }}</td>
              <td>{{ $jadwal->tgl_seminar }}</td>
              <td>{{ $jadwal->waktu_seminar }}</td>
              <td>{{ $jadwal->status }}</td>
              <td>
                <div class="btn btn-primary btn-sm btn-detail-jadwal" data-bs-toggle="modal" data-bs-target="#modal-detail-jadwal"
                data-mhs="{{ $jadwal->mahasiswa }}" data-jadwal="{{ $jadwal }}" data-dospem="{{ $jadwal->dosen_pembimbing }}"
                data-tgl-jadwal="{{ $jadwal->created_at }}">Detail</div>

                <div class="btn btn-danger btn-sm btn-delete-jadwal" data-jadwal="{{ $jadwal }}">
                  Delete
                </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>