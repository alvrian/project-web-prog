<x-layout>
    <x-navbar />

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Edit Compost Entry</h1>

        <form method="POST" action="{{ route('compost.update', $entry->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="compost_producer_name" class="form-label">Producer Name</label>
                <input 
                    type="text" 
                    name="compost_producer_name" 
                    id="compost_producer_name" 
                    class="form-control" 
                    value="{{ old('compost_producer_name', $entry->compost_producer_name) }}" 
                    required>
            </div>

            <div class="mb-3">
                <label for="compost_types_produced" class="form-label">Type of Compost Produced</label>
                <input 
                    type="text" 
                    name="compost_types_produced" 
                    id="compost_types_produced" 
                    class="form-control" 
                    value="{{ old('compost_types_produced', $entry->compost_types_produced) }}" 
                    required>
            </div>

            <div class="mb-3">
                <label for="average_compost_amount" class="form-label">Average Amount (kg)</label>
                <input 
                    type="number" 
                    name="average_compost_amount" 
                    id="average_compost_amount" 
                    class="form-control" 
                    value="{{ old('average_compost_amount', $entry->average_compost_amount) }}" 
                    required 
                    min="0" 
                    step="0.01">
            </div>

            <div class="mb-3">
                <label for="kitchen_waste_capacity" class="form-label">Kitchen Waste Capacity (kg)</label>
                <input 
                    type="number" 
                    name="kitchen_waste_capacity" 
                    id="kitchen_waste_capacity" 
                    class="form-control" 
                    value="{{ old('kitchen_waste_capacity', $entry->kitchen_waste_capacity) }}" 
                    required 
                    min="0" 
                    step="0.01">
            </div>

            <div class="mb-3">
                <label for="date_logged" class="form-label">Date Logged</label>
                <input 
                    type="date" 
                    name="date_logged" 
                    id="date_logged" 
                    class="form-control" 
                    value="{{ old('date_logged', $entry->date_logged ? $entry->date_logged->format('Y-m-d') : '') }}">
            </div>

            <div class="mb-3">
                <label for="price_per_item" class="form-label">Price Per Item ($)</label>
                <input 
                    type="number" 
                    name="price_per_item" 
                    id="price_per_item" 
                    class="form-control" 
                    value="{{ old('price_per_item', $entry->priceList->price_per_item ?? '') }}" 
                    min="0" 
                    step="0.01">
            </div>

            <div class="mb-3">
                <label for="price_per_subscription_3" class="form-label">3-Month Subscription ($)</label>
                <input 
                    type="number" 
                    name="price_per_subscription_3" 
                    id="price_per_subscription_3" 
                    class="form-control" 
                    value="{{ old('price_per_subscription_3', $entry->priceList->price_per_subscription_3 ?? '') }}" 
                    min="0" 
                    step="0.01">
            </div>

            <div class="mb-3">
                <label for="price_per_subscription_6" class="form-label">6-Month Subscription ($)</label>
                <input 
                    type="number" 
                    name="price_per_subscription_6" 
                    id="price_per_subscription_6" 
                    class="form-control" 
                    value="{{ old('price_per_subscription_6', $entry->priceList->price_per_subscription_6 ?? '') }}" 
                    min="0" 
                    step="0.01">
            </div>

            <div class="mb-3">
                <label for="price_per_subscription_9" class="form-label">9-Month Subscription ($)</label>
                <input 
                    type="number" 
                    name="price_per_subscription_9" 
                    id="price_per_subscription_9" 
                    class="form-control" 
                    value="{{ old('price_per_subscription_9', $entry->priceList->price_per_subscription_9 ?? '') }}" 
                    min="0" 
                    step="0.01">
            </div>

            <div class="mb-3">
                <label for="price_per_subscription_12" class="form-label">12-Month Subscription ($)</label>
                <input 
                    type="number" 
                    name="price_per_subscription_12" 
                    id="price_per_subscription_12" 
                    class="form-control" 
                    value="{{ old('price_per_subscription_12', $entry->priceList->price_per_subscription_12 ?? '') }}" 
                    min="0" 
                    step="0.01">
            </div>

            <div class="text-center mt-4 mb-4">
                <a href="{{ route('compost.index') }}" class="btn btn-light me-3">Cancel</a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>

        </form>
    </div>
</x-layout>
