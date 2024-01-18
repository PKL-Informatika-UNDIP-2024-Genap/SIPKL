<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th>Nama</th>
          <th>NIP</th>
          <th>Golongan</th>
          <th>Jabatan</th>
          <th>Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($dosbing as $index => $dos)
          <tr>
              <td></td>
              <td>{{ $dos->nama }}</td>
              <td>{{ $dos->nip }}</td>
              <td>{{ $dos->golongan }}</td>
              <td>{{ $dos->jabatan }}</td>
              <td>
                <div class="btn btn-primary btn-edit-dosbing" data-bs-toggle="modal" data-bs-target="#modal_edit_dosbing" 
                data-nip="{{ $dos->nip }}" data-nama="{{ $dos->nama }}" data-nip="{{ $dos->nip }}" 
                data-golongan="{{ $dos->golongan }}" data-jabatan="{{ $dos->jabatan }}">Edit</div>
                <div class="btn btn-danger btn-delete-dosbing" data-nip="{{ $dos->nip }}">
                  Delete
                </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>
