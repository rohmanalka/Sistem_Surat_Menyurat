<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\JenisSuratModel;
use App\Models\SuratModel;
use Barryvdh\DomPDF\Facade\Pdf;

#[Layout('components.layouts.app', [
    'title' => 'Detail Surat',
    'pageTitle' => 'Detail Surat'
])]

class ShowSurat extends Component
{
    public SuratModel $surat;
    public bool $showPdfModal = false;

    public function mount(SuratModel $surat)
    {
        $this->surat = $surat;
    }

    public function previewPdf()
    {
        $this->showPdfModal = true;
    }

    public function downloadPdf()
    {
        return response()->streamDownload(
            fn() => print(
                Pdf::loadView('pdf.surat', [
                    'surat' => $this->surat
                ])->output()
            ),
            'surat-' . $this->surat->nomor_surat . '.pdf'
        );
    }

    public function render()
    {
        return view('livewire.surat.show_surat', [
            'jenisSurat' => JenisSuratModel::all()
        ]);
    }
}
