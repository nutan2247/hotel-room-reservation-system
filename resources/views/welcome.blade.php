<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Room Reservation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .room {
            display: inline-block;
            width: 50px;
            margin: 3px;
            padding: 5px;
            text-align: center;
            border-radius: 5px;
            color: white;
        }
        .available { background-color: green; }
        .occupied { background-color: red; }
    </style>
</head>
<body class="p-4 bg-light">
    <div class="container">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="mb-4 text-center">Hotel Room Reservation System</h2>

        <div class="row">
            <div class="col-md-6 mb-4">
                {{-- Floor-wise Room Display --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                Room Layout (Green = Available, Red = Occupied)
            </div>
            <div class="card-body">
                <style>
                    .room {
                        display: inline-block;
                        width: 50px;
                        margin: 3px;
                        padding: 5px;
                        text-align: center;
                        border-radius: 5px;
                        color: white;
                        font-size: 14px;
                    }
                    .available { background-color: green; }
                    .occupied { background-color: red; }
                </style>

                @foreach ($rooms->groupBy('floor')->sortKeysDesc() as $floor => $floorRooms)
                    <h6 class="mt-3">Floor {{ $floor }}</h6>
                    <div class="mb-2">
                        @foreach ($floorRooms as $room)
                            <div class="room {{ $room->is_occupied ? 'occupied' : 'available' }}">
                                {{ $room->room_number }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
            </div>
            {{-- Booking Form --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        Book Rooms
                    </div>
                    <div class="card-body">
                        <form action="{{ route('book.rooms') }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label for="guest_name" class="form-label">Guest Name:</label>
                                <input type="text" id="guest_name" name="guest_name" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label for="room_count" class="form-label">Number of rooms (1-5):</label>
                                <input type="number" id="room_count" name="room_count" class="form-control" min="1" max="5" required>
                            </div>                            
                            <button type="submit" class="btn btn-success w-100">Book Now</button>
                        </form>
                    </div>
                </div>

            {{-- Actions --}}
                <div class="card shadow mt-4">
                    <div class="card-header bg-danger text-dark">
                        Admin Actions
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rooms.random') }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-warning w-100">Generate Random Occupancy</button>
                        </form>
                        <form action="{{ route('rooms.reset') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary w-100">Reset All Bookings</button>
                        </form>
                    </div>
                </div>
    

            {{-- Recent Bookings --}}
                <div class="card shadow mt-4">
                    <div class="card-header bg-info text-white">
                        Recent Bookings
                    </div>
                    <div class="card-body p-2">
                        @php
                            $recentBookings = \App\Models\Booking::latest()->take(5)->get();
                        @endphp
                        @if($recentBookings->isEmpty())
                            <p class="text-muted">No bookings yet.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                <ul class="list-group list-group-flush">
                                    @foreach($recentBookings as $booking)
                                        <li class="list-group-item small">
                                            <strong>{{ $booking->guest_name }}</strong> - 
                                            Rooms: {{ implode(', ', json_decode($booking->rooms_booked, true)) }} <br>
                                            <small class="text-muted">Travel Time: {{ $booking->total_travel_time }} mins</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</body>

</html>
