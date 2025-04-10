@extends('layouts.app')

@section('title', 'Daftar Booking: ' . $item->name)

@section('content')

<a href="{{ route('entities.show', $item->entity_id) }}"
   class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-md text-sm shadow mb-4">
    ← Kembali ke Detail
</a>

<div class="bg-white shadow rounded-xl p-4 overflow-x-auto">
    <h2 class="text-lg font-bold mb-4 text-blue-600">Booking untuk: {{ $item->name }}</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-sm shadow">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-sm shadow">
            {{ session('error') }}
        </div>
    @endif

    <table class="w-full text-sm text-left border rounded overflow-hidden">
        <thead class="bg-blue-50 border-b">
            <tr>
                <th class="p-2">#</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Kontak</th>
                <th class="p-2">Kode</th>
                <th class="p-2">Status</th>
                <th class="p-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr class="border-b hover:bg-gray-50 {{ $booking->confirmed_at ? 'bg-green-50' : '' }}">
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $booking->guest_name }}</td>
                    <td class="p-2">{{ $booking->contact }}</td>
                    <td class="p-2">{{ $booking->ref_code ?? '-' }}</td>
                    <td class="p-2">
                        @if ($booking->confirmed_at)
                            <span class="text-green-600 font-semibold">✅ Terkonfirmasi</span>
                        @else
                            <span class="text-gray-500 italic">Belum</span>
                        @endif
                    </td>
                    <td class="p-2 flex space-x-2 justify-center">
                        @if (!$booking->confirmed_at)
                            <form action="{{ route('bookings.confirm', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="text-blue-600 hover:text-blue-800" title="Konfirmasi">✔️</button>
                            </form>
                        @endif

                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="text-red-600 hover:text-red-800"
                                title="{{ $booking->confirmed_at ? 'Sudah dikonfirmasi, tidak bisa dihapus' : 'Hapus' }}"
                                {{ $booking->confirmed_at ? 'disabled class=opacity-50 cursor-not-allowed' : '' }}>
                                🗑️
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">Belum ada booking.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
