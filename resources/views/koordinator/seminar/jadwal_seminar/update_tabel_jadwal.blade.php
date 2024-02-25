<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th class="hari_tanggal">Hari, Tanggal</th>
          <th>Waktu</th>
          <th>Ruang</th>
          <th>Nama</th>
          <th>NIM</th>
          <th>Jenis</th>
          <th>Pembimbing</th>
          <th class="action">Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($data_jadwal as $jadwal)
          <tr>
              <td></td>
              <td>{{ $jadwal->tgl_seminar }}</td>
              <td>{{ $jadwal->waktu_seminar }}</td>
              <td>{{ $jadwal->ruang }}</td>
              <td>{{ $jadwal->mahasiswa->nama }}</td>
              <td>{{ $jadwal->nim }}</td>
              <td>{{ $jadwal->status }}</td>
              <td>{{ $jadwal->dosen_pembimbing->nama }}</td>
              <td>
                <div class="btn btn-primary btn-sm btn-detail-jadwal" data-bs-toggle="modal" data-bs-target="#modal-detail-jadwal"
                data-mhs="{{ $jadwal->mahasiswa }}" data-jadwal="{{ $jadwal }}" data-dospem="{{ $jadwal->dosen_pembimbing }}"
                data-tgl-jadwal="{{ $jadwal->created_at }}">Detail</div>
                <div class="btn btn-sm btn-danger btn-sm btn-delete-jadwal" data-nim="{{ $jadwal->nim }}">
                  Delete
                </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>