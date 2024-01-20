<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th>Tanggal</th>
          <th>Deskripsi</th>
          <th class="lampiran">Lampiran</th>
          <th class="action">Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($arr_dokumen as $dokumen)
          <tr>
              <td></td>
              <td>{{ date('d M Y', strtotime($dokumen->updated_at)) }}</td>
              <td>{{ $dokumen->deskripsi }}</td>
              <td>
                <a href="{{ $dokumen->lampiran }}" class="btn btn-primary">Download</a>
              </td>
              <td>
                  <div class="btn btn-primary btn-edit-dokumen" data-bs-toggle="modal" data-bs-target="#modal_edit_dokumen" 
                  data-id="{{ $dokumen->id }}" data-deskripsi="{{ $dokumen->deskripsi }}" data-lampiran="lampiran">Edit</div>
                  <div class="btn btn-danger btn-delete-dokumen" data-id="{{ $dokumen->id }}" data-deskripsi="{{ $dokumen->deskripsi }}">
                    Delete
                  </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>