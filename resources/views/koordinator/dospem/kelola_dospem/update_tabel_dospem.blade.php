<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th>Nama</th>
          <th>NIP</th>
          <th>Golongan</th>
          <th>Jabatan</th>
          <th class="action">Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($dospem as $index => $dos)
          <tr>
              <td></td>
              <td>{{ $dos->nama }}</td>
              <td>{{ $dos->nip }}</td>
              <td>{{ $dos->golongan }}</td>
              <td>{{ $dos->jabatan }}</td>
              <td>
                  <div class="btn btn-primary btn-edit-dospem" data-bs-toggle="modal" data-bs-target="#modal_edit_dospem" 
                  data-dospem="{{ $dos }}">Edit</div>
                  <div class="btn btn-danger btn-delete-dospem" data-id="{{ $dos->id }}" data-nip="{{ $dos->nip }}">
                    Delete
                  </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>