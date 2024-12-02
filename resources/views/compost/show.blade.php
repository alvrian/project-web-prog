<x-layout>
    <x-navbar />
    <div class="container">
        <h1 class="text-center">{{ $compost->compost_types_produced }}</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <img src="{{ asset('storage/default-compost.jpg') }}" class="img-fluid rounded" alt="{{ $compost->compost_types_produced }}">
            </div>
            <div class="col-md-6">
                <h4>Details</h4>
                <p>
                    <strong>Producer Name:</strong> {{ $compost->compost_producer_name }}<br>
                    <strong>Type:</strong> {{ $compost->compost_types_produced }}<br>
                    <strong>Average Compost Amount:</strong> {{ $compost->average_compost_amount }} kg<br>
                    <strong>Kitchen Waste Capacity:</strong> {{ $compost->kitchen_waste_capacity }} kg<br>
                    <strong>Date Logged:</strong> {{ $compost->date_logged->format('M d, Y') }}<br>
                </p>
                
                @if($compost->priceList)
                <h4>Price List</h4>
                <ul>
                    <li>Per Item: ${{ $compost->priceList->price_per_item }}</li>
                    <li>3-Month Subscription: ${{ $compost->priceList->price_per_subscription_3 }}</li>
                    <li>6-Month Subscription: ${{ $compost->priceList->price_per_subscription_6 }}</li>
                    <li>9-Month Subscription: ${{ $compost->priceList->price_per_subscription_9 }}</li>
                    <li>12-Month Subscription: ${{ $compost->priceList->price_per_subscription_12 }}</li>
                </ul>
                @else
                <p><strong>Pricing information is not available.</strong></p>
                @endif
                
                <a href="{{ route('compost.index') }}" class="btn btn-light">Back</a>
                <a href="{{ route('compost.edit', $compost->id) }}" class="btn btn-warning">Edit</a>
                @if($compost->priceList)
                <a href="{{ route('subscriptions.create', $compost->id) }}" class="btn btn-success">Subscribe</a>
                @endif
            </div>
        </div>
    </div>
</x-layout>
