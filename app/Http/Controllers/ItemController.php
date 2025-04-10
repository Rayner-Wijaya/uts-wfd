<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'entity_id' => 'required|exists:entities,id',
            'name' => 'required|string|max:255',
        ]);

        $entity = Entity::findOrFail($request->entity_id);

        // Validasi khusus berdasarkan jenis entitas
        if ($entity->name === 'Penerbangan') {
            $validated = $request->validate([
                'departure_airport' => 'required|string',
                'arrival_airport' => 'required|string',
                'departure_date' => 'required|date',
                'departure_time' => 'required',
                'arrival_date' => 'required|date',
                'arrival_time' => 'required',
            ]);
        } elseif ($entity->name === 'Pemesanan Hotel') {
            $validated = $request->validate([
                'room_type' => 'required|string',
                'location' => 'required|string|max:255',
            ]);
        } elseif ($entity->name === 'Pendaftaran Kursus') {
            $validated = $request->validate([
                'materi' => 'required|string',
                'pengajar' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'jam_kursus' => 'required',
            ]);
        } else {
            $validated = [];
        }

        // Gabungkan data umum dan khusus
        $data = array_merge(
            $request->only(['entity_id', 'name']),
            $validated
        );

        Item::create($data);

        return redirect()
            ->route('entities.show', $request->entity_id)
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
