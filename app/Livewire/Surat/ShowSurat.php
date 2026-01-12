<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\SuratModel;

#[Layout('components.layouts.app', [
    'title' => 'Detail Surat',
    'pageTitle' => 'Detail Surat'
])]
class ShowSurat extends Component
{
    public SuratModel $surat;
    public bool $showModal = true;

    public function mount(SuratModel $surat)
    {
        // route param otomatis masuk ke sini
        $this->surat = $surat->load('jenisSurat');

        // modal langsung terbuka
        $this->showModal = true;
    }

    public function closeModal()
    {
        return redirect()->route('surat.riwayat');
    }

    public function render()
    {
        return view('livewire.surat.show_surat');
    }
}
