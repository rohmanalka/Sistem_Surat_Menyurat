<?php

namespace App\Livewire\Surat;

use App\Models\SuratModel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\JenisSuratModel;

#[Layout('components.layouts.app', [
    'title' => 'Edit Surat',
    'pageTitle' => 'Edit Pengajuan Surat'
])]

class EditSurat extends Component
{
    public $surat;
    public $jenisSurat;

    public $id_jenis_surat;
    public $judul;
    public $isi;
    public $tanggal_surat;

    protected $rules = [
        'id_jenis_surat' => 'required',
        'judul' => 'required|string|max:255',
        'isi' => 'required',
        'tanggal_surat' => 'required|date',
    ];

    public function mount(SuratModel $surat)
    {
        $this->jenisSurat = JenisSuratModel::all();
        abort_if(
            $surat->id_user !== Auth::id() || $surat->status !== 'draft',
            403
        );

        $this->surat = $surat;
        $this->id_jenis_surat = $surat->id_jenis_surat;
        $this->judul = $surat->judul;
        $this->isi = $surat->isi;
        $this->tanggal_surat = $surat->tanggal_surat;
    }

    public function update()
    {
        $this->validate();

        $this->surat->update([
            'id_jenis_surat' => $this->id_jenis_surat,
            'judul' => $this->judul,
            'isi' => $this->isi,
            'tanggal_surat' => $this->tanggal_surat,
        ]);

        return redirect()->route('surat.riwayat')->with('success', 'Surat berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.surat.edit_surat');
    }
}
