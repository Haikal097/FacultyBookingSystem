<div class="col-md-6">
    <div class="room-card 
        {{ $room->status == 'maintenance' ? 'disabled-room' : '' }}" 
        @if($room->status != 'maintenance')
            onclick="selectRoom(this, {{ $room->id }}, {{ $room->price_per_hour }}, {{ $room->price_fullday }})"
        @endif
    >
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
        <div class="d-flex justify-content-between align-items-center mt-2">
            <div class="price-tag">
                <div class="d-flex">
                    <div class="pe-2 border-end">
                        <small class="text-muted d-block">Per Hour</small>
                        <strong>RM{{ number_format($room->price_per_hour, 2) }}</strong>
                    </div>
                    <div class="ps-2">
                        <small class="text-muted d-block">Full Day</small>
                        <strong>RM{{ number_format($room->price_fullday, 2) }}</strong>
                    </div>
                </div>
            </div>
            <span class="availability-badge 
                {{ $room->status == 'maintenance' ? 'bg-warning text-dark' : 'bg-success text-white' }}">
                {{ ucfirst($room->status) }}
            </span>
        </div>
    </div>
</div>

<style>
    .price-tag {
        background-color: #f8f9fa;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
    }
    
    /* Keep your existing styles and add this */
    .room-card {
        position: relative; /* For any future absolute positioning */
    }
    .disabled-room {
    pointer-events: none;
    opacity: 0.6;
    cursor: not-allowed;
}
</style>