<table class="table" id="myTable2">
  <thead>
    <tr class="table-primary">
      <th>No</th>
      <th>Nama Mahasiswa</th>
      <th>NIM</th>
      <th class="action justify-content-center d-flex">Assign</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data_mhs as $index => $mhs)
      <tr data-nim="{{ $mhs->nim }}">
        <td></td>
        <td class="details-control">
          {{ $mhs->nama }}
        </td>
        <td>{{ $mhs->nim }}</td>
        <td class="justify-content-center d-flex">
          <div class="form-check">
            <input class="form-check-input {{ $mhs->nip_dospem ? 'db-checked' : '' }}" 
            data-nim="{{ $mhs->nim }}" type="checkbox" {{ $mhs->nip_dospem ? 'checked' : '' }} 
            id="flexCheckDefault" disabled>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>