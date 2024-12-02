<x-layout>
    <x-navbar />

    <div class="container">
        <h1 class="text-center mb-4">Compost Entry Details</h1>

        <div class="row">
            <div class="col-md-6">
                <h4>Details</h4>
                <p>
                    {{-- <strong>Producer Name:</strong> {{ $entry->compost_producer_name }}<br> --}}
                    {{-- <strong>Producer Name:</strong> {{ $entry->compostProducer->compost_producer_name }}<br> --}}
                    <strong>Producer Name:</strong> {{ $entry->compost_producer_name }}<br>

                    {{-- <strong>Type:</strong> {{ $entry->compost_types_produced }}<br>
                    <strong>Average Amount:</strong> {{ $entry->average_compost_amount }} kg<br>
                    <strong>Kitchen Waste Capacity:</strong> {{ $entry->kitchen_waste_capacity }} kg<br>
                    <strong>Date Logged:</strong> 
                        @if($entry->date_logged)
                            {{ $entry->date_logged->format('M d, Y') }}
                        @else
                            <em>Not available</em>
                        @endif
                        <br>

                </p> --}}

                @if($entry->priceList)
                    <h4>Price List</h4>
                    <ul>
                        <li>Per Item: ${{ $entry->priceList->price_per_item }}</li>
                        <li>3-Month Subscription: ${{ $entry->priceList->price_per_subscription_3 }}</li>
                        <li>6-Month Subscription: ${{ $entry->priceList->price_per_subscription_6 }}</li>
                        <li>9-Month Subscription: ${{ $entry->priceList->price_per_subscription_9 }}</li>
                        <li>12-Month Subscription: ${{ $entry->priceList->price_per_subscription_12 }}</li>
                    </ul>
                @else
                    <p><strong>Pricing information is not available.</strong></p>
                @endif

                <a href="{{ route('compost.index') }}" class="btn btn-light">Back</a>
                {{-- <a href="{{ route('compost.edit', $entry->id) }}" class="btn btn-warning">Edit</a> --}}
                @if($entry->priceList)
                    {{-- <a href="{{ route('subscriptions.create', $entry->id) }}" class="btn btn-success">Subscribe</a> --}}
                @endif
            </div>
        </div>
    </div>
</x-layout>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var entryData = @json($entry);
        console.log(entryData);
    });
</script> --}}