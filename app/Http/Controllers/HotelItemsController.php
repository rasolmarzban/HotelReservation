<?php

namespace App\Http\Controllers;

use App\Models\HotelItem;
use Illuminate\Http\Request;

class HotelItemsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_no' => 'required|string',
            'types_of' => 'required|string',
            'members' => 'required|integer|min:1',
            'intake_date' => 'required|date',
            'outtake_date' => 'required|date|after:intake_date',
            'extra_feature' => 'nullable|string',
            'times' => 'required|integer|min:0',
        ]);

        HotelItem::create($request->all());

        return redirect()->back()->with('success', 'Room added successfully');
    }

    public function update(Request $request, HotelItem $hotelItem)
    {
        $request->validate([
            'room_no' => 'required|string',
            'types_of' => 'required|string',
            'members' => 'required|integer|min:1',
            'intake_date' => 'required|date',
            'outtake_date' => 'required|date|after:intake_date',
            'extra_feature' => 'nullable|string',
        ]);

        $hotelItem->update($request->all());

        return redirect()->back()->with('success', 'Room updated successfully');
    }

    public function destroy(HotelItem $hotelItem)
    {
        $hotelItem->delete();
        return redirect()->back()->with('success', 'Room deleted successfully');
    }
}
