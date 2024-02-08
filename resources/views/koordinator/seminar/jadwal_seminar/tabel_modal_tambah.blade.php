<table class="table" id="myTable2">
  <thead>
    <tr class="table-primary">
      <th>No</th>
      <th>Nama Mahasiswa</th>
      <th>NIM</th>
      <th>Dosen Pembimbing</th>
      <th class="action assign">Assign</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($mhs_aktif as $mhs)
      <tr data-nim="{{ $mhs->nim }}" data-pkl="{{ $mhs->pkl }}" data-dospem="{{ $mhs->dosen_pembimbing }}">
        <td></td>
        <td class="details-control">
          {{ $mhs->nama }}
        </td>
        <td>{{ $mhs->nim }}</td>
        <td>{{ $mhs->dosen_pembimbing ? $mhs->dosen_pembimbing->nama : "-" }}</td>
        <td class="assign">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" data-nim="{{ $mhs->nim }}" data-id-dospem="{{ $mhs->id_dospem }}">
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>