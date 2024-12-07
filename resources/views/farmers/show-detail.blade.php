<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">{{ $crop->crop_name }}</h1>

        <div class="card mb-4 shadow-sm">
            @if($crop->crop_image)
                <img src="{{ asset('storage/' . $crop->crop_image) }}" class="card-img-top" alt="Crop Image">
            @endif
            <div class="card-body">
                <h5 class="card-title">Crop Details</h5>
                <p class="card-text">
                    <strong>Type:</strong> {{ $crop->crop_type }}<br>
                    <strong>Farmer:</strong> {{ $farmer->Name ?? 'N/A' }}<br>
                    <strong>Location:</strong> {{ $farmer->Location ?? 'N/A' }}<br>
                    <strong>Average Amount:</strong> {{ $crop->average_amount ?? 'N/A' }} kg<br>
                    <strong>Harvest Cycles:</strong> {{ $crop->harvest_cycles ?? 'N/A' }}<br>
                    <strong>Available From:</strong> {{ $crop->availability_start?->format('Y-m-d') ?? 'N/A' }}<br>
                    <strong>Available To:</strong> {{ $crop->availability_end?->format('Y-m-d') ?? 'N/A' }}<br>
                    <strong>Price:</strong> ${{ $crop->prices?->price_per_kg ?? 'N/A' }} per kg
                </p>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
