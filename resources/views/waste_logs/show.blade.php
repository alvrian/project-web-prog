<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">{{ $owner->Name }}</h1>
        <p><strong>Location:</strong> {{ $owner->Location ?? 'N/A' }}</p>
        <p><strong>Restaurant Type:</strong> {{ $owner->Type ?? 'N/A' }}</p>
        <p><strong>Average Waste Per Month:</strong> {{ $owner->AverageFoodWastePerMonth ?? 'N/A' }} kg</p>

        <h2 class="mt-4">Waste Logs</h2>
        @if($wasteLogs->isEmpty())
            <div class="alert alert-warning text-center">
                No waste logs available.
            </div>
        @else
            <div class="row">
                @foreach($wasteLogs as $log)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Waste Type: {{ $log->WasteType }}</h5>
                                <p class="card-text">
                                    <strong>Weight:</strong> {{ $log->Weight }} kg<br>
                                    <strong>Date Logged:</strong> {{ $log->DateLogged }}<br>
                                    <strong>Price Per Kg:</strong> ${{ $log->priceList->price_per_kg ?? 'N/A' }}<br>
                                    <strong>Subscription Prices:</strong>
                                <ul>
                                    <li>3 months: ${{ $log->priceList->price_per_subscription_3 ?? 'N/A' }}</li>
                                    <li>6 months: ${{ $log->priceList->price_per_subscription_6 ?? 'N/A' }}</li>
                                    <li>9 months: ${{ $log->priceList->price_per_subscription_9 ?? 'N/A' }}</li>
                                    <li>12 months: ${{ $log->priceList->price_per_subscription_12 ?? 'N/A' }}</li>
                                </ul>
                                </p>
                                <a href="{{ route('resto-owners.show-detail', ['ownerID' => $owner->user_id, 'wastelogID' => $log->id]) }}"
                                   class="btn btn-dark">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
