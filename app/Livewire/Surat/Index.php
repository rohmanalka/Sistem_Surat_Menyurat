<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\SuratModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app', [
    'title' => 'Riwayat Pengajuan Surat',
    'pageTitle' => 'Riwayat Pengajuan Surat'
])]

class Index extends Component
{
    public function delete($id_surat)
    {
        $surat = SuratModel::where('id_surat', $id_surat)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        if (in_array($surat->status, ['approved', 'rejected'])) {
            session()->flash('error', 'Surat tidak dapat dihapus.');
            return;
        }

        $surat->delete();

        session()->flash('success', 'Surat berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.surat.index', [
            'surat' => SuratModel::where('id_user', Auth::id())
                ->latest()
                ->get()
        ]);
    }
}
