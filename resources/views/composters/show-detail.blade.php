<x-layout>
    <x-navbar />

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Compost Details</h1>

        <div class="card mb-4">
            <div class="card-body">

                <h5 class="card-title">{{ $compostEntry->compost_types_produced }}</h5>
                <p class="card-text">
                    <strong>Producer:</strong> {{ $compostEntry->compostProducer->Name ?? 'N/A' }}<br>
                    <strong>Average Amount:</strong> {{ $compostEntry->average_compost_amount ?? 'N/A' }}<br>
                    <strong>Kitchen Waste Capacity:</strong> {{ $compostEntry->kitchen_waste_capacity ?? 'N/A' }}<br>
                    <strong>Price Per Item:</strong> ${{ $compostEntry->priceList->price_per_item ?? 'N/A' }}<br>
                    <strong>Subscription Prices:</strong>
                <ul>
                    <li>3 months: ${{ $compostEntry->priceList->price_per_subscription_3 ?? 'N/A' }}</li>
                    <li>6 months: ${{ $compostEntry->priceList->price_per_subscription_6 ?? 'N/A' }}</li>
                    <li>9 months: ${{ $compostEntry->priceList->price_per_subscription_9 ?? 'N/A' }}</li>
                    <li>12 months: ${{ $compostEntry->priceList->price_per_subscription_12 ?? 'N/A' }}</li>
                </ul>
                </p>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    <form action="{{ route('subscription.store') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="hidden" name="compost_entry_id" value="{{ $compostEntry->id }}">
                        <select name="subscription_type" class="form-select me-2" required>
                            <option value="" disabled selected>Choose Subscription</option>
                            <option value="3">3 Months - ${{ $compostEntry->priceList->price_per_subscription_3 ?? 'N/A' }}</option>
                            <option value="6">6 Months - ${{ $compostEntry->priceList->price_per_subscription_6 ?? 'N/A' }}</option>
                            <option value="9">9 Months - ${{ $compostEntry->priceList->price_per_subscription_9 ?? 'N/A' }}</option>
                            <option value="12">12 Months - ${{ $compostEntry->priceList->price_per_subscription_12 ?? 'N/A' }}</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
