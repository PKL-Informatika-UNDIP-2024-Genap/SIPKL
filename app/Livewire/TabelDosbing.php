<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DosenPembimbing;

class TabelDosbing extends Component
{
    public $search = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'userCreated' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.tabel-dosbing',[
            'dosbing' => DosenPembimbing::where('nama', 'like', '%'.$this->search.'%')->paginate(5)
        ]);
    }

    public function delete($nip)
    {
        DosenPembimbing::where("nip", "=", $nip)->delete();
        session()->flash('success', 'Dosen Pembimbing successfully deleted.');
    }

    public function updatingSearch(){
        $this->resetPage();
    }
}
