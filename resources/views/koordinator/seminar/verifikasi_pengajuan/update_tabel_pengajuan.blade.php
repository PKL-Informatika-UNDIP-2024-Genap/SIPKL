<table class="table" id="myTable">
    <thead>
        <tr class="table-primary">
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Tanggal Pengajuan</th>
            <th class="action">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_pengajuan as $pengajuan)
            <tr>
                <td></td>
                <td>{{ $pengajuan->nama_mhs }}</td>
                <td>{{ $pengajuan->nim }}</td>
                <td>{{ $pengajuan->created_at }}</td>
                <td>
                  <div class="btn btn-sm btn-primary btn-detail-pengajuan" data-bs-toggle="modal" data-bs-target="#modal-detail-pengajuan"
                  data-pengajuan="{{ $pengajuan }}"
                  data-tgl-pengajuan="{{ $pengajuan->created_at }}">Detail</div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>