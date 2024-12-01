<x-layout>
    <x-navbar/>
    
    <div class="container">
        <h1 class="text-center">Place Order for {{ $crop->crop_name }}</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="crop_id" value="{{ $crop->id }}">

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity (kg)</label>
                        <input type="number" name="quantity" class="form-control" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price Per Kg</label>
                        <input type="text" class="form-control" value="{{ $crop->prices->price_per_kg }}" readonly>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>