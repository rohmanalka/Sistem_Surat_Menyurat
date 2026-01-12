<div>
    @if ($showModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <div class="bg-white w-full max-w-6xl h-[90vh] rounded shadow flex flex-col">

                {{-- Header --}}
                <div class="flex justify-between items-center px-6 py-4 border-b">
                    <h3 class="font-semibold text-lg">Detail Surat</h3>
                    <button wire:click="closeModal" class="text-red-600">✕</button>
                </div>

                {{-- Content --}}
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4 p-6 overflow-hidden">

                    {{-- DETAIL --}}
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="font-medium">Nomor Surat</p>
                            <p>{{ $surat->nomor_surat }}</p>
                        </div>

                        <div>
                            <p class="font-medium">Jenis Surat</p>
                            <p>{{ $surat->jenisSurat->nama ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="font-medium">Tanggal</p>
                            <p>{{ $surat->tanggal_surat }}</p>
                        </div>

                        <div>
                            <p class="font-medium">Status</p>
                            <x-status_badge :status="$surat->status" />
                        </div>
                    </div>

                    {{-- PDF LANGSUNG --}}
                    <div class="md:col-span-2 border rounded overflow-hidden">
                        <iframe src="{{ route('surat.pdf.preview', $surat->id_surat) }}" class="w-full h-full">
                        </iframe>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
