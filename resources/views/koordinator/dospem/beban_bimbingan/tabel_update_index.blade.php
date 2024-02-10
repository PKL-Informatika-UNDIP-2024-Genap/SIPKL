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
    @foreach ($arr_dospem as $dospem)
      <tr>
        <td></td>
        <td>{{ $dospem->nama }}</td>
        <td>{{ $dospem->nip }}</td>
        <td>{{ $dospem->jml_bimbingan }}</td>
        <td>
          <div class="btn btn-primary btn-detail" data-dospem="{{ $dospem }}" data-bs-toggle="modal" data-bs-target="#modal-detail">
            Detail
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>