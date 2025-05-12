<div class="col-md-6">
    <div class="room-card" onclick="selectRoom(this, {{ $room->id }})">
        <div class="d-flex align-items-center">
            <div class="room-type-icon 
                @if($room->type == 'Lecture Hall') bg-primary
                @elseif($room->type == 'Meeting Room') bg-success
                @elseif($room->type == 'Computer Lab') bg-info
                @elseif($room->type == 'Sports Facility') bg-warning
                @else bg-secondary
                @endif">
                <i class="@if($room->type == 'Lecture Hall') fas fa-chalkboard-teacher
                          @elseif($room->type == 'Meeting Room') fas fa-users
                          @elseif($room->type == 'Computer Lab') fas fa-laptop
                          @elseif($room->type == 'Sports Facility') fas fa-running
                          @else fas fa-door-open
                          @endif"></i>
            </div>
            <div class="flex-grow-1">
                <h6 class="mb-1">{{ $room->name }}</h6>
                <div class="d-flex justify-content-between">
                    <small class="text-muted">{{ $room->building }} {{ $room->floor }}</small>
                    <span class="room-capacity">
                        <i class="fas fa-users me-1"></i> {{ $room->capacity }}
                    </span>
                </div>
            </div>
        </div>
        <div class="mt-2">
            @if($room->features)
                @foreach(explode(',', $room->features) as $feature)
                    <span class="badge bg-light text-dark me-1">{{ trim($feature) }}</span>
                @endforeach
            @endif
        </div>
        <div class="mt-2 text-end">
            <span class="availability-badge bg-success text-white">Available</span>
        </div>
    </div>
</div>
