<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th class="hari_tanggal">Tanggal</th>
          <th>Deskripsi</th>
          <th class="lampiran">Lampiran</th>
          <th class="action">Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($arr_dokumen as $dokumen)
          <tr>
              <td></td>
              <td>{{ $dokumen->updated_at }}</td>
              <td>{{ $dokumen->deskripsi }}</td>
              <td class="py-0 align-middle">
                <a href="{{ $dokumen->lampiran }}" class="btn btn-sm btn-primary">Download</a>
              </td>
              <td class="py-0 align-middle">
                  <div class="btn btn-sm btn-primary btn-edit-dokumen" data-bs-toggle="modal" data-bs-target="#modal_edit_dokumen" 
                  data-id="{{ $dokumen->id }}" data-deskripsi="{{ $dokumen->deskripsi }}" data-lampiran="lampiran">Edit</div>
                  <div class="btn btn-sm btn-danger btn-delete-dokumen" data-id="{{ $dokumen->id }}" data-deskripsi="{{ $dokumen->deskripsi }}">
                    Delete
                  </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>