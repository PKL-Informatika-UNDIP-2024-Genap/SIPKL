<table class="table" id="myTable">
  <thead>
      <tr class="table-primary">
          <th>No</th>
          <th>Periode</th>
          <th>Tanggal Mulai</th>
          <th>Tanggal Selesai</th>
          <th>Status</th>
          <th class="action">Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($data_periode as $periode)
          <tr>
              <td></td>
              <td>{{ $periode->id_periode }}</td>
              <td>{{ $periode->tgl_mulai }}</td>
              <td>{{ $periode->tgl_selesai }}</td>
              <td>
                @if (date('Y-m-d') >= $periode->tgl_mulai && date('Y-m-d') <= $periode->tgl_selesai)
                  <span class="badge bg-primary">Aktif</span>
                @elseif($periode->tgl_selesai < date('Y-m-d'))
                  <span class="badge bg-success">Selesai</span>
                @else
                  <span class="badge bg-secondary">Mendatang</span>
                @endif
              </td>
              <td>
                  <div class="btn btn-sm btn-info btn-edit-periode" data-bs-toggle="modal" data-bs-target="#modal-edit-periode" 
                  data-prev-periode="{{isset($data_periode[$loop->index + 1]) ? $data_periode[$loop->index + 1] : ""}}" data-periode="{{ $periode }}">Edit</div>
                  <div class="btn btn-sm btn-danger btn-delete-periode {{ date('Y-m-d') > $periode->tgl_selesai ? 'disabled' : '' }}" data-id-periode="{{ $periode->id_periode }}">
                    Delete
                  </div>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>