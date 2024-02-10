<table class="table" id="myTable2">
  <thead>
    <tr class="table-primary">
      <th>No</th>
      <th>Nama Mahasiswa</th>
      <th>NIM</th>
      <th>Periode PKL</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($arr_mhs as $mhs)
      <tr data-nim="{{ $mhs->nim }}" data-pkl="{{ $mhs->pkl }}">
        <td></td>
        <td class="details-control">
          {{ $mhs->nama }}
        </td>
        <td>{{ $mhs->nim }}</td>
        <td>{{ $mhs->periode_pkl ? $mhs->periode_pkl : "-" }}</td>
      </tr>
    @endforeach
  </tbody>
</table>