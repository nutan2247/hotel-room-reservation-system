<?php

namespace Database\Seeders;
use App\Models\Room;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Floors 1 to 9 (10 rooms each)
        for ($floor = 1; $floor <= 9; $floor++) {
            for ($i = 1; $i <= 10; $i++) {
                $roomNumber = $floor * 100 + $i;
                Room::create([
                    'floor' => $floor,
                    'room_number' => $roomNumber,
                ]);
            }
        }

        // Floor 10 (7 rooms)
        for ($i = 1; $i <= 7; $i++) {
            $roomNumber = 1000 + $i;
            Room::create([
                'floor' => 10,
                'room_number' => $roomNumber,
            ]);
        }
    }
}
