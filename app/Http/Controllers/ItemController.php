<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Item;
use App\Models\Entity;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create(Entity $entity)
    {
        return view('items.create', compact('entity'));
    }

    

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'entity_id' => 'required|exists:entities,id',
        'name' => 'required|string',

        // ✈ PENERBANGAN
        'departure_airport' => 'nullable|string',
        'arrival_airport' => 'nullable|string',
        'departure_date' => 'nullable|date',
        'departure_time' => 'nullable',
        'arrival_date' => 'nullable|date|after_or_equal:departure_date',
        'arrival_time' => 'nullable',

        // 🏨 HOTEL
        'location' => 'nullable|string',
        'room_type' => 'nullable|string',
        'checkin_date' => 'nullable|date',
        'checkout_date' => 'nullable|date|after_or_equal:checkin_date',

        // 📚 KURSUS
        'materi' => 'nullable|string',
        'pengajar' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'jam_kursus' => 'nullable',
    ]);

    $validator->after(function ($validator) use ($request) {

        // ✈ Cek logika waktu tiba lebih awal dari berangkat
        if (
            $request->departure_date &&
            $request->arrival_date &&
            $request->departure_date === $request->arrival_date &&
            $request->departure_time &&
            $request->arrival_time &&
            $request->departure_time > $request->arrival_time
        ) {
            $validator->errors()->add('arrival_time', 'Jam tiba tidak boleh lebih awal dari jam berangkat pada tanggal yang sama.');
        }

        // 🏨 Cek logika tanggal check-out lebih awal dari check-in
        if (
            $request->checkin_date &&
            $request->checkout_date &&
            $request->checkout_date < $request->checkin_date
        ) {
            $validator->errors()->add('checkout_date', 'Tanggal check-out tidak boleh lebih awal dari check-in.');
        }

        // 📚 Kursus: tanggal end harus ≥ start → sudah diatur di rules
        // Jam kursus tidak divalidasi karena tidak ada jam mulai/akhir, cukup bebas
    });

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    Item::create($validator->validated());

    return redirect()->route('entities.show', $request->entity_id)
        ->with('success', 'Item berhasil ditambahkan!');
}

    public function markDone(Item $item)
    {
        $item->update([
            'is_done' => true,
        ]);

        return back()->with('success', 'Item ditandai selesai.');
    }

    public function destroy(Item $item)
    {
        if (!$item->is_done) {
            $item->delete();
            return back()->with('success', 'Item berhasil dihapus.');
        }

        return back()->with('error', 'Item yang sudah selesai tidak bisa dihapus.');
    }

    public function show(Item $item)
    {
        $item->load('bookings');
        return view('items.show', compact('item'));
    }
}
