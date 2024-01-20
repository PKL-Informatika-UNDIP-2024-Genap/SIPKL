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
      @foreach ($arr_pengumuman as $pengumuman)
          <tr>
              <td></td>
              <td>{{ date('d M Y', strtotime($pengumuman->updated_at)) }}</td>
              <td>{{ $pengumuman->deskripsi }}</td>
              <td>
                <a href="{{ $pengumuman->lampiran }}" class="btn btn-primary">Download</a>
              </td>
              <td>
                  <div class="btn btn-primary btn-edit-pengumuman" data-bs-toggle="modal" data-bs-target="#modal_edit_pengumuman" 
                  data-id="{{ $pengumuman->id }}" data-deskripsi="{{ $pengumuman->deskripsi }}" data-lampiran="lampiran">Edit</div>
                  <div class="btn btn-danger btn-delete-pengumuman" data-id="{{ $pengumuman->id }}" data-deskripsi="{{ $pengumuman->deskripsi }}">
                    Delete
                  </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>