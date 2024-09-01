<table class="table" id="myTable2" style="width: 100%">
  <thead>
    <tr class="table-primary">
      <th>No</th>
      <th>Nama Mahasiswa</th>
      <th>NIM</th>
      <th class="judul-pkl">Judul PKL</th>
      <th class="instansi-pkl">Instansi</th>
      <th class="assign">Assign</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data_mhs as $index => $mhs)
      <tr data-nim="{{ $mhs->nim }}" data-instansi="{{ $mhs->instansi }}" data-judul="{{ $mhs->judul }}">
        <td></td>
        <td class="details-control">
          {{ $mhs->nama }}
        </td>
        <td>{{ $mhs->nim }}</td>
        <td class="judul-pkl">{{ $mhs->judul }}</td>
        <td class="instansi-pkl">{{ $mhs->instansi }}</td>
        <td class="assign">
          <div class="form-check">
            <input class="form-check-input {{ $mhs->id_dospem ? 'db-checked' : '' }}" 
            data-nim="{{ $mhs->nim }}" type="checkbox" {{ $mhs->id_dospem ? 'checked' : '' }} 
            id="flexCheckDefault" disabled>
          </div>
          @if ($mhs->id_dospem)
            <p class="d-none">checked</p>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>