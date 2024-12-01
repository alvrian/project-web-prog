<x-layout>
    <x-navbar/>
    <div class="container">
        <h1 class="text-center">{{ $crop->crop_name }}</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $crop->crop_image) }}" class="img-fluid rounded" alt="{{ $crop->crop_name }}">
            </div>
            <div class="col-md-6">
                <h4>Details</h4>
                <p>
                    <strong>Type:</strong> {{ $crop->crop_type }}<br>
                    <strong>Average Amount:</strong> {{ $crop->average_amount }} kg<br>
                    <strong>Harvest Cycles:</strong> {{ $crop->harvest_cycles }} per year<br>
                    <strong>Price:</strong> {{ $crop->prices->price_per_kg }} per kg<br>
                    <strong>Available:</strong> {{ $crop->availability_start->format('M d, Y') }} - {{ $crop->availability_end->format('M d, Y') }}
                </p>
                <a href="{{ route('orders.create', $crop->id) }}" class="btn btn-success">Place Order</a>
            </div>
        </div>
    </div>
</x-layout>