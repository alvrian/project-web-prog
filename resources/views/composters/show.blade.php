<x-layout>
    <x-navbar/>
    <div class="d-flex justify-content-center align-items-center"
         style="background-color: #43553D;min-height:120vh;font-family:&quot;Inter&quot;, serif;">
        <div style="background-color: white; min-height: 80vh;width:95%; border-radius: 12px;padding:1rem;">

            <div class="container">
                <h1 class="text-center mt-4 mb-4">{{ $producer->Name }}</h1>
                <p class="text-center"><strong>Location:</strong> {{ $producer->Location ?? 'N/A' }}</p>
                <p class="text-center"><strong>Compost Types
                        Produced:</strong> {{ $producer->CompostTypesProduced ?? 'N/A' }}</p>

                <h2 class="mt-4">Available Compost Items</h2>
                @if($compostEntries->isEmpty())
                    <div class="alert alert-warning text-center">
                        No compost items available.
                    </div>
                @else
                    <div class="row">
                        @foreach($compostEntries as $entry)
                            <div class="col-md-4 mb-3">
                                <div class="card position-relative card border-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Compost Type: {{ $entry->compost_types_produced }}</h5>
                                        <p class="card-text">
                                            <strong>Average
                                                Amount:</strong> {{ $entry->average_compost_amount ?? 'N/A' }}<br>
                                            <strong>Price Per Item:</strong>
                                            ${{ $entry->priceList->price_per_item ?? 'N/A' }}
                                            <br>
                                            <strong>Subscription Prices:</strong>
                                        <ul>
                                            <li>3 months:
                                                ${{ $entry->priceList->price_per_subscription_3 ?? 'N/A' }}</li>
                                            <li>6 months:
                                                ${{ $entry->priceList->price_per_subscription_6 ?? 'N/A' }}</li>
                                            <li>9 months:
                                                ${{ $entry->priceList->price_per_subscription_9 ?? 'N/A' }}</li>
                                            <li>12 months:
                                                ${{ $entry->priceList->price_per_subscription_12 ?? 'N/A' }}</li>
                                        </ul>
                                        </p>
                                        <a href="{{ route('composters.show-detail', ['composterId' => $producer->user_id, 'compostId' => $entry->id]) }}"
                                           class="btn btn-dark">View Details</a>
                                        {{-- <a href="{{ route('composters.show-detail', ['id' => $entry->id]) }}" class="btn btn-primary">View Details</a>--}}
                                    </div>

                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
