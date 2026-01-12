<div class="max-w-4xl bg-white p-6 rounded shadow space-y-4">

    <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold">
            Detail Surat
        </h2>

        <div class="flex gap-2">
            <button wire:click="previewPdf" class="px-3 py-2 bg-gray-600 text-white rounded text-sm">
                Preview PDF
            </button>

            <button wire:click="downloadPdf" class="px-3 py-2 bg-blue-600 text-white rounded text-sm">
                Download PDF
            </button>
        </div>
    </div>

    <table class="w-full text-sm">
        <tr>
            <td class="font-medium w-40">Nomor Surat</td>
            <td>{{ $surat->nomor_surat }}</td>
        </tr>
        <tr>
            <td class="font-medium">Jenis Surat</td>
            <td>{{ $surat->jenisSurat->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="font-medium">Tanggal</td>
            <td>{{ $surat->tanggal_surat }}</td>
        </tr>
        <tr>
            <td class="font-medium">Status</td>
            <td>
                <x-status_badge :status="$surat->status" />
            </td>
        </tr>
    </table>

    <div>
        <p class="font-medium mb-1">Isi Surat</p>
        <div class="border rounded p-4 bg-gray-50 whitespace-pre-line">
            {{ $surat->isi }}
        </div>
    </div>


    <div class="md:col-span-2 flex justify-end gap-2 pt-4">
        <a href="{{ route('surat.riwayat') }}" class="px-4 py-2 rounded border">
            Tutup
        </a>
    </div>

    @if ($showPdfModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white w-11/12 h-[90vh] rounded shadow relative">

                <button wire:click="$set('showPdfModal', false)" class="absolute top-2 right-2 text-red-600">
                    ✕
                </button>

                <iframe src="{{ route('surat.pdf.preview', $surat->id_surat) }}" class="w-full h-full rounded">
                </iframe>
            </div>
        </div>
    @endif

</div>
