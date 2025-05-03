<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function generateRandom()
    {
        // Reset all rooms first
        Room::query()->update(['is_occupied' => false]);

        // Get a random 50% of rooms (adjust count if needed)
        $roomIds = Room::inRandomOrder()->limit(48)->pluck('id');

        Room::whereIn('id', $roomIds)->update(['is_occupied' => true]);
        return redirect('/')->with('success', 'Random occupancy applied.');

        // return response()->json(['status' => 'success', 'message' => 'Random occupancy applied.']);
    }

    public function reset()
    {
        Room::query()->update(['is_occupied' => false]);

        // return response()->json(['status' => 'success', 'message' => 'All bookings reset.']);
        return redirect('/')->with('success', 'All bookings have been reset.');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
