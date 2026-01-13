<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\SuratModel;
use App\Models\JenisSuratModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app', [
    'title' => 'Pengajuan Surat',
    'pageTitle' => 'Pengajuan Surat'
])]

class CreateSurat extends Component
{
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

    public function simpan()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
        ]);

        SuratModel::create([
            'id_user' => Auth::id(),
            'id_jenis_surat' => $this->id_jenis_surat,
            'nomor_surat' => $this->generateNomorSurat(),
            'judul' => $this->judul,
            'isi' => $this->isi,
            'tanggal_surat' => $this->tanggal_surat ?? now(),
            'status' => 'draft',
        ]);

        return redirect()
            ->route('surat.riwayat')
            ->with('success', 'Surat berhasil disimpan sebagai draft.');
    }

    public function submit()
    {
        $this->validate();

        SuratModel::create([
            'id_user' => Auth::id(),
            'id_jenis_surat' => $this->id_jenis_surat,
            'nomor_surat' => $this->generateNomorSurat(),
            'judul' => $this->judul,
            'isi' => $this->isi,
            'tanggal_surat' => $this->tanggal_surat,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('pegawai.surat.riwayat')
            ->with('success', 'Surat berhasil diajukan.');
    }

    private function generateNomorSurat()
    {
        $tanggal = now()->format('d');
        $bulan = now()->format('m');
        $tahun = now()->format('Y');
        $kode = JenisSuratModel::find($this->id_jenis_surat)->kode ?? 'SURAT';

        $last = SuratModel::whereYear('created_at', $tahun)
            ->orderBy('id_surat', 'desc')
            ->first();

        $urut = $last ? ((int) substr($last->nomor_surat, 0, 3) + 1) : 1;
        $urut = str_pad($urut, 3, '0', STR_PAD_LEFT);

        return "{$urut}/{$kode}/{$tanggal}/{$bulan}/{$tahun}";
    }


    public function render()
    {
        return view('livewire.surat.create_surat', [
            'jenisSurat' => JenisSuratModel::all(),
        ]);
    }
}
