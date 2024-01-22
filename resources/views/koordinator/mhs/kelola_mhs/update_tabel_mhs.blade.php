<table class="table" id="myTable">
<thead>
    <tr class="table-primary">
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Status</th>
        <th class="action">Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($arr_mhs as $mhs)
        <tr>
            <td></td>
            <td>{{ $mhs->nama }}</td>
            <td>{{ $mhs->nim }}</td>
            <td>{{ $mhs->status }}</td>
            <td>
                <div class="btn btn-primary btn-edit-mhs" data-bs-toggle="modal" data-bs-target="#modal_edit_mhs" 
                data-nim="{{ $mhs->nim }}" data-nama="{{ $mhs->nama }}" data-status="{{ $mhs->status }}" 
                data-no-wa="{{ $mhs->no_wa }}" data-email="{{ $mhs->email }}" data-nip-dospem="{{ $mhs->nip_dospem }}"
                data-periode-pkl="{{ $mhs->periode_pkl }}">Edit</div>
                <div class="btn btn-warning btn-reset-pass" data-nim="{{ $mhs->nim }}">
                    Reset Password
                  </div>
                <div class="btn btn-danger btn-delete-mhs" data-nim="{{ $mhs->nim }}">
                    Delete
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
</table>