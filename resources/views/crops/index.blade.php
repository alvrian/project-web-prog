<x-layout>
    <x-navbar/>

<div class="container">
    <h1 class="text-center mb-4">My Available Crops</h1>

    <form action="{{ route('crops.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="crop_type" class="form-select">
                    <option value="">Select Crop Type</option>
                    <option value="Vegetables" {{ request('crop_type') == 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
                    <option value="Fruits" {{ request('crop_type') == 'Fruits' ? 'selected' : '' }}>Fruits</option>
                    <option value="Grains" {{ request('crop_type') == 'Grains' ? 'selected' : '' }}>Grains</option>
                    <option value="Other" {{ request('crop_type') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>
    

    <div class="row">
        @forelse($crops as $crop)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $crop->crop_image) }}" class="card-img-top" alt="{{ $crop->crop_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $crop->crop_name }}</h5>
                        <p class="card-text">
                            <strong>Type:</strong> {{ $crop->crop_type }}<br>
                            <strong>Available:</strong> {{ $crop->availability_start->format('M d, Y') }} - {{ $crop->availability_end->format('M d, Y') }}
                        </p>
                        <a href="{{ route('crops.show', $crop->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No crops available for the selected filters.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $crops->links() }}
    </div>
</div>


</x-layout>