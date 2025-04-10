@extends('layouts.app')

@section('title', 'Detail: ' . $item->name)

@section('content')
<a href="{{ route('entities.show', $item->entity_id) }}"
   class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-md text-sm shadow mb-4">
    ← Kembali ke {{ $item->entity->name }}
</a>

<div class="bg-white p-6 rounded-xl shadow space-y-2">
    <h2 class="text-xl font-bold text-blue-700">{{ $item->name }}</h2>

    {{-- ✈️ PENERBANGAN --}}
    @if($item->entity->name === 'Penerbangan')
        <p><strong>Dari:</strong> {{ $item->departure_airport }} ➡️ {{ $item->arrival_airport }}</p>
        <p><strong>Berangkat:</strong> {{ $item->departure_date }} {{ $item->departure_time }}</p>
        <p><strong>Tiba:</strong> {{ $item->arrival_date }} {{ $item->arrival_time }}</p>
    @endif

    {{-- 🏨 HOTEL --}}
    @if($item->entity->name === 'Pemesanan Hotel')
        <p><strong>Lokasi:</strong> {{ $item->location }}</p>
        <p><strong>Tipe Kamar:</strong> {{ $item->room_type }}</p>
    @endif

    {{-- 📚 KURSUS --}}
    @if($item->entity->name === 'Pendaftaran Kursus')
        <p><strong>Materi:</strong> {{ $item->materi }}</p>
        <p><strong>Pengajar:</strong> {{ $item->pengajar }}</p>
        <p><strong>Jadwal:</strong> {{ $item->start_date }} s/d {{ $item->end_date }}</p>
        <p><strong>Jam:</strong> {{ $item->jam_kursus }}</p>
    @endif
</div>

{{-- DAFTAR BOOKING --}}
@if($item->bookings->count())
    <div class="mt-6 bg-white p-4 rounded-xl shadow space-y-1 border-t">
        <h3 class="font-semibold text-blue-700">Daftar Booking</h3>
        <ul class="text-sm list-disc list-inside">
            @foreach($item->bookings as $booking)
                <li>{{ $booking->guest_name }} 
                    @if($booking->ref_code) - {{ $booking->ref_code }} @endif
                </li>
            @endforeach
        </ul>
    </div>
@else
    <p class="text-gray-500 mt-4">Belum ada booking.</p>
@endif

{{-- BUTTON BOOKING --}}
@if(!$item->is_done)
    <a href="{{ route('bookings.create', $item->id) }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded shadow text-sm mt-4 inline-block">
        Book Sekarang
    </a>
@else
    <button class="bg-gray-400 text-white px-3 py-1 rounded shadow text-sm cursor-not-allowed mt-4" disabled>
        Booking Ditutup
    </button>
@endif

@endsection
