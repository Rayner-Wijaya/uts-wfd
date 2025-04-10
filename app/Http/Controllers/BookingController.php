<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;


class BookingController extends Controller
{
    public function create(Item $item)
    {
        if ($item->is_done) {
        return redirect()->route('entities.show', $item->entity_id)
                         ->with('error', 'Penerbangan sudah selesai. Tidak bisa booking tiket.');
    }

    return view('bookings.create', compact('item'));
    }


    public function store(Request $request, $itemId)
{
    $item = Item::findOrFail($itemId);

    $validated = $request->validate([
        'guest_name' => 'required|string|max:255',
        'contact' => 'required|string|max:50',
        'ref_code' => 'nullable|string|max:50',
    ]);

    $validated['item_id'] = $item->id;

    Booking::create($validated);

    return redirect()->route('bookings.index', $item->id)
                     ->with('success', 'Booking berhasil dibuat!');
}


    public function index($itemId)
    {
        $item = Item::findOrFail($itemId);
        $bookings = Booking::where('item_id', $itemId)->get();

        return view('bookings.index', compact('item', 'bookings'));
    }
    public function confirm(Booking $booking)
{
    $booking->update([
        'confirmed_at' => now(),
    ]);

    return back()->with('success', 'Booking dikonfirmasi.');
}

public function destroy(Booking $booking)
{
    if ($booking->confirmed_at) {
        return back()->with('error', 'Booking yang sudah dikonfirmasi tidak bisa dihapus.');
    }

    $booking->delete();

    return back()->with('success', 'Booking berhasil dihapus.');
}

}
