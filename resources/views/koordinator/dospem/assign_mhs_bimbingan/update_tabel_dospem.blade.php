<table class="table" id="myTable">
  <thead>
    <tr class="table-primary">
      <th>No</th>
      <th>Nama</th>
      <th>NIP</th>
      <th>Jumlah Bimbingan</th>
      <th class="action">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data_dospem as $index => $dospem)
      <tr>
        <td></td>
        <td>{{ $dospem->nama }}</td>
        <td>{{ $dospem->nip }}</td>
        <td>{{ $dospem->jumlah_bimbingan ?? 0 }}</td>
        <td>
            <div class="btn btn-primary btn-assign-mhs" data-nama="{{ $dospem->nama }}" data-nip="{{ $dospem->nip }}" data-bs-toggle="modal" data-bs-target="#modal_assign_mhs">
              Assign Mahasiswa
            </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>