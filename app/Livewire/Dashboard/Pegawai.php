<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\SuratModel;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app', [
    'title' => 'Dashboard Pegawai',
    'pageTitle' => 'Dashboard Pegawai'
])]

class Pegawai extends Component
{
    public $pending = 0;
    public $approved = 0;
    public $rejected = 0;
    public $riwayatSurat = [];

    public function mount()
    {
        $userId = Auth::id();

        $counts = SuratModel::where('id_user', $userId)
            ->selectRaw("
        SUM(status = 'pending') as pending,
        SUM(status = 'approved') as approved,
        SUM(status = 'rejected') as rejected
    ")->first();

        $this->pending  = $counts->pending;
        $this->approved = $counts->approved;
        $this->rejected = $counts->rejected;

        $this->riwayatSurat = SuratModel::with('jenisSurat')
            ->where('id_user', $userId)
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.pegawai');
    }
}
