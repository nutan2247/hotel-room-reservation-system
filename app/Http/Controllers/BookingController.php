<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::orderBy('floor')->orderBy('room_number')->get();
        return view('welcome', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $count = $request->input('room_count');
    
        if ($count < 1 || $count > 5) {
            return back()->with('error', 'You can only book 1 to 5 rooms.');
        }
    
        $availableRooms = Room::where('is_occupied', false)->orderBy('floor')->orderBy('room_number')->get();
    
        $bestSet = null;
        $minTravelTime = PHP_INT_MAX;
    
        // Group by floor to try same-floor booking first
        $grouped = $availableRooms->groupBy('floor');
    
        foreach ($grouped as $floor => $rooms) {
            $rooms = $rooms->pluck('room_number')->sort()->values();
            for ($i = 0; $i <= $rooms->count() - $count; $i++) {
                $subset = $rooms->slice($i, $count);
                $travelTime = ($subset->last() - $subset->first()); // horizontal travel
    
                if ($travelTime < $minTravelTime) {
                    $bestSet = $subset;
                    $minTravelTime = $travelTime;
                }
            }
        }
    
        // If no same-floor match, look across floors
        if (!$bestSet || $bestSet->count() < $count) {
            $candidates = $availableRooms->take(30); // reduce computation
    
            $combinations = $candidates->combinations($count);
            foreach ($combinations as $combo) {
                $floors = $combo->pluck('floor')->unique();
                $roomNumbers = $combo->pluck('room_number')->sort()->values();
    
                $horizontal = ($roomNumbers->last() - $roomNumbers->first());
                $vertical = ($floors->max() - $floors->min()) * 2;
    
                $totalTime = $horizontal + $vertical;
    
                if ($totalTime < $minTravelTime) {
                    $bestSet = $combo->pluck('room_number');
                    $minTravelTime = $totalTime;
                }
            }
        }
    
        if (!$bestSet || $bestSet->count() < $count) {
            return back()->with('error', 'Not enough rooms available.');
        }
    
        // Mark rooms as occupied
        Room::whereIn('room_number', $bestSet)->update(['is_occupied' => true]);
    
        // Save booking
        Booking::create([
            'guest_name' => $request->input('guest_name'),
            'rooms_booked' => $bestSet->values(),
            'total_travel_time' => $minTravelTime
        ]);
    
        return back()->with('success', 'Rooms booked: ' . $bestSet->implode(', ') . '. Total travel time: ' . $minTravelTime . ' minutes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
