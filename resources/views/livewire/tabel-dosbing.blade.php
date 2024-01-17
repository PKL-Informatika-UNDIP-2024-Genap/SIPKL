<div>
    <div class="mb-3">
        <input type="text" class="form-control" wire:model.live='search' placeholder="search user">
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Golongan</th>
                <th>Jabatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosbing as $index => $dos)
                <tr>
                    <td>{{ $dosbing->firstItem() + $index }}</td>
                    <td>{{ $dos->nama }}</td>
                    <td>{{ $dos->nip }}</td>
                    <td>{{ $dos->golongan }}</td>
                    <td>{{ $dos->jabatan }}</td>
                    <td>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $dosbing->links() }}
</div>
