<x-layout>
    <x-navbar/>

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

                <div class="d-flex justify-content-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal"
                            data-bs-target="#subscribeModal">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subscribeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('subscription.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="compost_entry_id" value="{{ $compostEntry->id }}">
                    <input type="hidden" name="ProviderID" value="{{ $compostEntry->compost_producer_id }}">
                    <input type="hidden" name="SubscriberID" value="{{ auth()->id() }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="subscribeModalLabel">Confirm Subscription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="subscription_type" class="form-label">Subscription Type</label>
                            <select name="subscription_type" id="subscription_type" class="form-select" required>
                                <option value="" disabled selected>Select a subscription</option>
                                @if($compostEntry->priceList)
                                    @if($compostEntry->priceList->price_per_subscription_3)
                                        <option value="3">3 Months -
                                            ${{ $compostEntry->priceList->price_per_subscription_3 }}</option>
                                    @endif
                                    @if($compostEntry->priceList->price_per_subscription_6)
                                        <option value="6">6 Months -
                                            ${{ $compostEntry->priceList->price_per_subscription_6 }}</option>
                                    @endif
                                    @if($compostEntry->priceList->price_per_subscription_9)
                                        <option value="9">9 Months -
                                            ${{ $compostEntry->priceList->price_per_subscription_9 }}</option>
                                    @endif
                                    @if($compostEntry->priceList->price_per_subscription_12)
                                        <option value="12">12 Months -
                                            ${{ $compostEntry->priceList->price_per_subscription_12 }}</option>
                                    @endif
                                @else
                                    <option value="" disabled>No subscription options available</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" id="start_date" name="StartDate" class="form-control"
                                   value="{{ now()->toDateString() }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="text" id="end_date" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" id="price" class="form-control" readonly>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="redeem_points" name="redeem_points"
                                       value="1">
                                <label class="form-check-label" for="redeem_points">Redeem Points</label>
                            </div>
                            <div id="points_info" style="display: none;">
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="flex-fill me-3">
                                        <label for="points_used" class="form-label">Points to Redeem</label>
                                        <input type="number" id="points_used" name="points_used" class="form-control"
                                               min="0" max="{{ $totalPoints }}" placeholder="Enter points to redeem"
                                               required>
                                        <div class="form-text text-muted">
                                            You have {{ $totalPoints }} points available.
                                        </div>
                                    </div>
                                    <div class="flex-fill ms-3">
                                        <label for="final_price" class="form-label">Final Price</label>
                                        <input type="text" id="final_price" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason (Optional)</label>
                            <textarea id="reason" class="form-control" name="Reason"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        document.getElementById('subscription_type').addEventListener('change', function () {
            const subscriptionType = this.value;
            const priceList = @json($compostEntry->priceList);
            let endDate = new Date();
            let price = 0;

            if (subscriptionType === '3') {
                endDate.setMonth(endDate.getMonth() + 3);
                price = priceList.price_per_subscription_3;
            } else if (subscriptionType === '6') {
                endDate.setMonth(endDate.getMonth() + 6);
                price = priceList.price_per_subscription_6;
            } else if (subscriptionType === '9') {
                endDate.setMonth(endDate.getMonth() + 9);
                price = priceList.price_per_subscription_9;
            } else if (subscriptionType === '12') {
                endDate.setMonth(endDate.getMonth() + 12);
                price = priceList.price_per_subscription_12;
            }

            const day = String(endDate.getDate()).padStart(2, '0');
            const month = String(endDate.getMonth() + 1).padStart(2, '0');
            const year = endDate.getFullYear();
            document.getElementById('end_date').value = `${day}/${month}/${year}`;
            document.getElementById('price').value = '$' + price;

            updateFinalPrice(price);
        });

        const redeemPointsCheckbox = document.getElementById('redeem_points');
        const pointsInfoDiv = document.getElementById('points_info');
        const pointsInput = document.getElementById('points_used');

        redeemPointsCheckbox.addEventListener('change', function () {
            if (this.checked) {
                pointsInfoDiv.style.display = 'block';
                pointsInput.max = {{ $totalPoints }};
            } else {
                pointsInfoDiv.style.display = 'none';
                pointsInput.value = '';
                const price = parseFloat(document.getElementById('price').value.replace('$', ''));
                updateFinalPrice(price);
            }
        });

        pointsInput.addEventListener('input', function () {
            const pointsUsed = parseInt(this.value) || 0;
            const price = parseFloat(document.getElementById('price').value.replace('$', ''));
            updateFinalPrice(price, pointsUsed);
        });

        function updateFinalPrice(price, pointsUsed = 0) {
            const finalPrice = price - pointsUsed;
            document.getElementById('final_price').value = '$' + finalPrice.toFixed(2);
        }
    </script>
</x-layout>
