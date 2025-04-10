@extends('layouts.app')

@section('title', 'Daftar Data')

@section('content')
    <div class="grid gap-4">
        @foreach($entities as $entity)
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition duration-300 flex justify-between items-center border-l-4 border-blue-500">
                <div>
                    <h2 class="text-lg font-bold text-blue-700">{{ $entity->name }}</h2>
                    <p class="text-sm text-gray-500">Klik untuk melihat detail dan tambah data</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('entities.show', $entity->id) }}"
                       class="bg-blue-100 text-blue-700 px-4 py-1 rounded hover:bg-blue-200 text-sm font-medium shadow">
                        Lihat
                    </a>
                    <a href="{{ route('items.create', $entity->id) }}"
                       class="bg-green-100 text-green-700 px-4 py-1 rounded hover:bg-green-200 text-sm font-medium shadow">
                        + Tambah
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
