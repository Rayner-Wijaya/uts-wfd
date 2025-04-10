@extends('layouts.app')

@section('title', 'Tambah Item')

@section('content')
@if($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded shadow mb-4">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<a href="{{ route('entities.show', $entity->id) }}"
   class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-md text-sm shadow">
    ← Kembali
</a>

<form method="POST" action="{{ route('items.store') }}" class="space-y-4 bg-white p-6 rounded-xl shadow-md mt-4">
    @csrf
    <input type="hidden" name="entity_id" value="{{ $entity->id }}">

    {{-- Nama Umum --}}
    <div>
        <label class="block font-semibold">Nama</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
    </div>

    {{-- ✈️ PENERBANGAN --}}
    @if($entity->name === 'Penerbangan')
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Bandara Keberangkatan</label>
            <input type="text" name="departure_airport" class="form-input w-full border rounded">
        </div>
        <div>
            <label>Bandara Tujuan</label>
            <input type="text" name="arrival_airport" class="form-input w-full border rounded">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Tanggal Berangkat</label>
            <input type="date" name="departure_date" class="form-input w-full border rounded">
        </div>
        <div>
            <label>Jam Berangkat</label>
            <input type="time" name="departure_time" class="form-input w-full border rounded">
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Tanggal Tiba</label>
            <input type="date" name="arrival_date" class="form-input w-full border rounded">
        </div>
        <div>
            <label>Jam Tiba</label>
            <input type="time" name="arrival_time" class="form-input w-full border rounded">
        </div>
    </div>
    @endif

    {{-- 🏨 HOTEL --}}
    @if($entity->name === 'Pemesanan Hotel')
    <div>
        <label>Lokasi</label>
        <input type="text" name="location" class="form-input w-full border rounded" required>
    </div>
    <div>
        <label>Tipe Kamar</label>
        <input type="text" name="room_type" class="form-input w-full border rounded" required>
    </div>
    @endif

    {{-- 📚 KURSUS --}}
    @if($entity->name === 'Pendaftaran Kursus')
    <div>
        <label>Materi</label>
        <input type="text" name="materi" class="form-input w-full border rounded">
    </div>
    <div>
        <label>Pengajar</label>
        <input type="text" name="pengajar" class="form-input w-full border rounded">
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-input w-full border rounded">
        </div>
        <div>
            <label>Tanggal Selesai</label>
            <input type="date" name="end_date" class="form-input w-full border rounded">
        </div>
    </div>
    <div>
        <label>Jam Kursus</label>
        <input type="time" name="jam_kursus" class="form-input w-full border rounded">
    </div>
    @endif

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
        Simpan
    </button>
</form>
@endsection
