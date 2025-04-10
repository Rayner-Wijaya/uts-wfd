@extends('layouts.app')

@section('title', 'Detail: ' . $entity->name)

@section('content')

<a href="{{ route('entities.index') }}"
   class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-md text-sm shadow">
    ← Kembali
</a>

<div class="mt-4 space-y-4">
    @forelse($items as $item)
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-md flex flex-col sm:flex-row justify-between items-start sm:items-center border-l-4 border-blue-500">
            <div class="space-y-1">
                <h3 class="text-lg font-bold text-blue-700">{{ $item->name }}</h3>

                {{-- ==================== IF: PENERBANGAN ==================== --}}
                @if($entity->name === 'Penerbangan')
                    <p><strong>Dari:</strong> {{ $item->departure_airport }} ➡️ {{ $item->arrival_airport }}</p>
                    <p><strong>Berangkat:</strong> {{ $item->departure_date }} {{ $item->departure_time }}</p>
                    <p><strong>Tiba:</strong> {{ $item->arrival_date }} {{ $item->arrival_time }}</p>
                @endif

                {{-- ==================== IF: HOTEL ==================== --}}
                @if($entity->name === 'Pemesanan Hotel' || $entity->name === 'Penginapan')
                    <p><strong>Tipe Kamar:</strong> {{ $item->room_type }}</p>
                    <p><strong>Lokasi:</strong> {{ $item->location }}</p>
                @endif

                {{-- ==================== IF: KURSUS ==================== --}}
                @if($entity->name === 'Pendaftaran Kursus')
                    <p><strong>Materi:</strong> {{ $item->materi }}</p>
                    <p><strong>Pengajar:</strong> {{ $item->pengajar }}</p>
                    <p><strong>Jadwal:</strong> {{ $item->start_date }} s/d {{ $item->end_date }}</p>
                    <p><strong>Jam:</strong> {{ $item->jam_kursus }}</p>
                @endif

                {{-- Tombol aksi tambahan --}}
                <div class="flex space-x-3 mt-2">
                    @if(!$item->is_done)
                    <a href="{{ route('bookings.create', $item->id) }}"
                        class="text-sm text-indigo-600 hover:underline">
                        🎟️ Book 
                    </a>
                    @endif
                    <a href="{{ route('bookings.index', $item->id) }}"
                       class="text-sm text-gray-600 hover:underline">
                        🔍 Detail 
                    </a>
                </div>

                @if($item->is_done)
                    <span class="inline-block text-green-600 text-sm mt-1">✔️ Selesai</span>
                @endif
            </div>

            {{-- Tombol aksi kanan --}}
            <div class="flex space-x-2 mt-3 sm:mt-0 sm:ml-4">
                @if(!$item->is_done)
                    <form method="POST" action="{{ route('items.done', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="text-blue-600 hover:text-blue-800">✔️</button>
                    </form>
                @endif

                <form method="POST" action="{{ route('items.destroy', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button
                        title="{{ $item->is_done ? 'Tidak bisa dihapus' : 'Hapus' }}"
                        class="text-red-600 hover:text-red-800"
                        {{ $item->is_done ? 'disabled' : '' }}>
                        🗑️
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Belum ada item untuk entitas ini.</p>
    @endforelse
</div>
@endsection
