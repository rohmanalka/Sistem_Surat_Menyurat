<div>
    <div class="flex justify-between mb-4">
        <h2 class="text-lg font-semibold">Pengajuan Surat</h2>
        <a href="{{ route('surat.pengajuan') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Ajukan Surat
        </a>
    </div>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="border-b">
                <th class="p-3 text-left">Judul</th>
                <th class="text-left">Tanggal</th>
                <th class="text-left">Status</th>
                <th class="text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($surat as $item)
                <tr class="border-b">
                    <td class="p-3">{{ $item->judul }}</td>
                    <td>{{ $item->tanggal_surat }}</td>
                    <td>
                        <x-status_badge :status="$item->status" />
                    </td>
                    <td class="space-x-2">
                        <a href="{{ route('surat.show', $item->id_surat) }}"
                            class="px-2 py-1 rounded text-sm bg-blue-200 text-blue-800">
                            Detail
                        </a>

                        @if ($item->status === 'draft')
                            <a href="{{ route('surat.edit', $item->id_surat) }}"
                                class="px-2 py-1 rounded text-sm bg-orange-200 text-orange-800">
                                Edit
                            </a>
                            <button wire:click="delete({{ $item->id_surat }})"
                                wire:confirm="Yakin ingin menghapus surat ini?"
                                class="px-2 py-1 rounded text-sm bg-red-200 text-red-800">
                                Hapus
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        Belum ada surat
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
