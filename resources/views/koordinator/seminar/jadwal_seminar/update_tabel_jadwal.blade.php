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
              <td>{{ $jadwal->nama_mhs }}</td>
              <td>{{ $jadwal->nim }}</td>
              {{-- <td>{{ Carbon\Carbon::parse($jadwal->tgl_seminar)->isoFormat('dddd, D MMMM Y') }}</td> --}}
              <td>{{ $jadwal->tgl_seminar }}</td>
              <td>{{ $jadwal->waktu_seminar }}</td>
              <td>{{ $jadwal->status }}</td>
              <td>
                <div class="btn btn-primary btn-sm btn-detail-jadwal" data-bs-toggle="modal" data-bs-target="#modal-detail-jadwal"
                data-jadwal="{{ $jadwal }}"
                data-tgl-jadwal="{{ $jadwal->created_at }}">Detail</div>

                <div class="btn btn-sm btn-danger btn-sm btn-delete-jadwal" data-nim="{{ $jadwal->nim }}">
                  Delete
                </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>