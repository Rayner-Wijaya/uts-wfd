@extends('layouts.app')

@section('title', 'Booking untuk ' . $item->name)

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow space-y-6">
    <h2 class="text-xl font-bold text-center text-blue-700">Form Booking</h2>

    <div class="text-center text-sm text-gray-600">
        <p>{{ $item->name }}</p>
        <p class="italic">{{ $item->entity->name }}</p>
    </div>

    {{-- Flash error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.store', $item->id) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold text-sm mb-1">Nama Tamu / Peserta</label>
            <input type="text" name="guest_name" class="w-full border rounded-md px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold text-sm mb-1">Kontak (HP / Email)</label>
            <input type="text" name="contact" class="w-full border rounded-md px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold text-sm mb-1">Kode Referensi (kursi, kamar, kode)</label>
            <input type="text" name="ref_code" class="w-full border rounded-md px-3 py-2">
        </div>

        {{-- ==================== ✈️ PENERBANGAN ==================== --}}
        @if($item->entity->name === 'Penerbangan')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-sm mb-1">Tanggal Boarding</label>
                    <input type="date" name="boarding_date" class="w-full border rounded-md px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold text-sm mb-1">Jam Boarding</label>
                    <input type="time" name="boarding_time" class="w-full border rounded-md px-3 py-2">
                </div>
            </div>
        @endif

        {{-- ==================== 🏨 PENGINAPAN ==================== --}}
        @if($item->entity->name === 'Pemesanan Hotel')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-sm mb-1">Tanggal Check-in</label>
                    <input type="date" name="checkin_date" class="w-full border rounded-md px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold text-sm mb-1">Tanggal Check-out</label>
                    <input type="date" name="checkout_date" class="w-full border rounded-md px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-sm mb-1">Jumlah Tamu</label>
                <input type="number" name="guests" class="w-full border rounded-md px-3 py-2">
            </div>
        @endif

        {{-- ==================== 📚 KURSUS ==================== --}}
        @if($item->entity->name === 'Pendaftaran Kursus')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-sm mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="w-full border rounded-md px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold text-sm mb-1">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="w-full border rounded-md px-3 py-2">
                </div>
            </div>
            <div>
                <label class="block font-semibold text-sm mb-1">Jam Kursus</label>
                <input type="time" name="jam_kursus" class="w-full border rounded-md px-3 py-2">
            </div>
        @endif

        <div class="flex justify-between pt-4">
            <a href="{{ route('entities.show', $item->entity_id) }}"
               class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md shadow text-sm">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
                Simpan Booking
            </button>
        </div>
    </form>
</div>
@endsection
