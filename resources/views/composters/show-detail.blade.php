<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Compost Details</h1>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $compostEntry->compost_types_produced }}</h5>
                <p class="card-text">
                    <strong>Producer:</strong> {{ $compostEntry->compostProducer->compost_producer_id ?? 'N/A' }}<br>
                    <strong>Producer ID</strong> {{$compostEntry->compost_producer_id ?? 'N/A'}}<br>
                    <strong>Average Amount:</strong> {{ $compostEntry->average_compost_amount ?? 'N/A' }} kg<br>
                    <strong>Kitchen Waste Capacity:</strong> {{ $compostEntry->kitchen_waste_capacity ?? 'N/A' }} kg<br>
                    <strong>Price Per Item:</strong> ${{ $compostEntry->priceList->price_per_item ?? 'N/A' }}<br>
                    <strong>Subscription Prices:</strong>
                </p>
                <ul>
                    <ul class="mb-1">3 months:
                        ${{ $compostEntry->priceList->price_per_subscription_3 ?? 'N/A' }}</ul>
                    <ul class="mb-1">6 months:
                        ${{ $compostEntry->priceList->price_per_subscription_6 ?? 'N/A' }}</ul>
                    <ul class="mb-1">9 months:
                        ${{ $compostEntry->priceList->price_per_subscription_9 ?? 'N/A' }}</ul>
                    <ul class="mb-1">12 months:
                        ${{ $compostEntry->priceList->price_per_subscription_12 ?? 'N/A' }}</ul>
                </ul>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                    <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal"
                            data-bs-target="#subscribeModal">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="subscribeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="subscribeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('subscription.storeFarmerSubscribeCompost') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ProviderID" value="{{ $compostEntry->compost_producer_id }}">
                        <input type="hidden" name="SubscriberID" value="{{ auth()->id() }}">
                        <input type="hidden" name="ProductableType" value="compost_entries">
                        <input type="hidden" name="ProductableID" value="{{ $compostEntry->id }}">
                        <input type="hidden" name="EndDate" id="EndDate">

                        <div class="modal-header">
                            <h5 class="modal-title" id="subscribeModalLabel">Confirm Subscription</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="SubscriptionType" class="form-label">Subscription Type</label>
                                <select name="SubscriptionType" id="SubscriptionType" class="form-select" required>
                                    <option value="" disabled selected>Select a subscription</option>
                                    <option value="3">3 Months -
                                        ${{ $compostEntry->priceList->price_per_subscription_3 }}</option>
                                    <option value="6">6 Months -
                                        ${{ $compostEntry->priceList->price_per_subscription_6 }}</option>
                                    <option value="9">9 Months -
                                        ${{ $compostEntry->priceList->price_per_subscription_9 }}</option>
                                    <option value="12">12 Months -
                                        ${{ $compostEntry->priceList->price_per_subscription_12 }}</option>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" id="start_date" name="StartDate" class="form-control"
                                       value="{{ now()->toDateString() }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" id="price" class="form-control" readonly>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="redeem_points"
                                           name="redeem_points" value="1">
                                    <label class="form-check-label" for="redeem_points">Redeem Points</label>
                                </div>
                                <div id="points_info" class="mt-3" style="display: none;">
                                    <div class="mb-2">
                                        <label for="points_used" class="form-label">Points to Redeem</label>
                                        <input type="number" id="points_used" name="points_used" class="form-control"
                                               min="0" max="{{ $totalPoints }}" placeholder="Enter points">
                                    </div>
                                    <p class="text-muted">You have <strong>{{ $totalPoints }}</strong> points available.
                                    </p>
                                    <div id="points_warning" class="text-danger small" style="display: none;">
                                        Insufficient points balance.
                                    </div>
                                    <label for="final_price" class="form-label mt-2">Final Price</label>
                                    <input type="text" id="final_price" class="form-control" readonly>
                                </div>
                            </div>
                            <input type="hidden" name="Price" id="hidden_price">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel
                            </button>
                            <button type="submit" class="btn btn-success">Confirm Subscription</button>
                        </div>
                    </form>

                </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            const subscriptionTypeSelect = document.getElementById('SubscriptionType');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('EndDate');
            const priceInput = document.getElementById('price');
            const redeemPointsCheckbox = document.getElementById('redeem_points');
            const pointsInfo = document.getElementById('points_info');
            const pointsUsedInput = document.getElementById('points_used');
            const pointsWarning = document.getElementById('points_warning');
            const finalPriceInput = document.getElementById('final_price');
            const hiddenPriceInput = document.getElementById('hidden_price');

            const maxPoints = {{ $totalPoints }};
            let basePrice = 0;

            const prices = {
                3: {{ $compostEntry->priceList->price_per_subscription_3 ?? '0' }},
                6: {{ $compostEntry->priceList->price_per_subscription_6 ?? '0' }},
                9: {{ $compostEntry->priceList->price_per_subscription_9 ?? '0' }},
                12: {{ $compostEntry->priceList->price_per_subscription_12 ?? '0' }}
            };

            subscriptionTypeSelect.addEventListener('change', function () {
                const selectedOption = this.value;
                basePrice = prices[selectedOption] || 0;

                priceInput.value = `$${basePrice.toFixed(2)}`;
                hiddenPriceInput.value = basePrice.toFixed(2);

                const startDate = new Date(startDateInput.value);
                if (selectedOption) {
                    startDate.setMonth(startDate.getMonth() + parseInt(selectedOption));
                    endDateInput.value = startDate.toISOString().split('T')[0];
                }

                updateFinalPrice();
            });

            redeemPointsCheckbox.addEventListener('change', function () {
                pointsInfo.style.display = this.checked ? 'block' : 'none';
                pointsUsedInput.value = '';
                pointsWarning.style.display = 'none';
                updateFinalPrice();
            });

            pointsUsedInput.addEventListener('input', function () {
                const pointsUsed = parseInt(this.value) || 0;

                if (pointsUsed > maxPoints) {
                    pointsWarning.style.display = 'block';
                    pointsWarning.textContent = 'You cannot use more points than your current balance.';
                    finalPriceInput.value = 'N/A';
                } else if (pointsUsed < 0) {
                    pointsWarning.style.display = 'block';
                    pointsWarning.textContent = 'Points cannot be negative.';
                    finalPriceInput.value = 'N/A';
                } else {
                    pointsWarning.style.display = 'none';
                    updateFinalPrice(pointsUsed);
                }
            });

            function updateFinalPrice(pointsUsed = 0) {
                const discount = pointsUsed || 0;
                const finalPrice = Math.max(basePrice - discount, 0);
                finalPriceInput.value = `$${finalPrice.toFixed(2)}`;
                hiddenPriceInput.value = finalPrice.toFixed(2);
            }
        });

        document.getElementById('SubscriptionType').addEventListener('change', function () {
            const subscriptionType = this.value;
            let endDate = new Date();
            if (subscriptionType === '3') {
                endDate.setMonth(endDate.getMonth() + 3);
            } else if (subscriptionType === '6') {
                endDate.setMonth(endDate.getMonth() + 6);
            } else if (subscriptionType === '9') {
                endDate.setMonth(endDate.getMonth() + 9);
            } else if (subscriptionType === '12') {
                endDate.setMonth(endDate.getMonth() + 12);
            }
            const day = String(endDate.getDate()).padStart(2, '0');
            const month = String(endDate.getMonth() + 1).padStart(2, '0');
            const year = endDate.getFullYear();
            document.getElementById('EndDate').value = `${day}/${month}/${year}`;
        });

    </script>
</x-layout>

@if(session('subscription_data'))
    <script>
        console.log('Subscription Data:', @json(session('subscription_data')));
    </script>
@endif

