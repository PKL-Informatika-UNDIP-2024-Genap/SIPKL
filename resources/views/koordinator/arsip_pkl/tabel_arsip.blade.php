<div data-arsip="{{ $arr_arsip }}" id="data-arsip"></div>
<table class="table" id="myTable">
  <thead>
    <tr class="table-primary">
      <th>No</th>
      <th>Nama</th>
      <th>NIM</th>
      <th>Periode PKL</th>
      <th>Nilai</th>
      <th class="action">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($arr_arsip as $arsip)
      <tr>
        <td></td>
        <td>{{ $arsip->nama }}</td>
        <td>{{ $arsip->nim }}</td>
        <td>{{ $arsip->periode_pkl }}</td>
        <td>{{ $arsip->nilai }}</td>
        <td>
          <div class="btn btn-primary btn-detail-mhs btn-sm" data-bs-toggle="modal" data-bs-target="#modal_detail_mhs" data-mhs="{{ $arsip }}">
            Detail
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>