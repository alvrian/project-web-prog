
<x-layout>
    <h1>Add Price for Crop: {{ $crop->name }}</h1>
    <form action="{{ route('prices.store', $crop->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="price_per_kg" class="form-label">Price per kg</label>
            <input type="number" name="price_per_kg" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Price</button>
    </form>
</x-layout>
