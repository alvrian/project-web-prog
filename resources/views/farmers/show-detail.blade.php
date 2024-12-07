<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Crop Details</h1>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $crop->crop_name }}</h5>
                <p class="card-text">
                    <strong>Farmer:</strong> {{ $crop->farmer->name ?? 'N/A' }}<br>
                    <strong>Crop Type:</strong> {{ $crop->crop_type ?? 'N/A' }}<br>
                    <strong>Average Amount:</strong> {{ $crop->average_amount ?? 'N/A' }} kg<br>
                    <strong>Harvest Cycles:</strong> {{ $crop->harvest_cycles ?? 'N/A' }} per year<br>
                    <strong>Availability Period:</strong>
                    {{ $crop->availability_start ? $crop->availability_start->format('d M Y') : 'N/A' }}
                    to
                    {{ $crop->availability_end ? $crop->availability_end->format('d M Y') : 'N/A' }}<br>
                    <strong>Price:</strong> ${{ $crop->priceList->price_per_item ?? 'N/A' }}
                </p>
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
                    <form action="{{ route('subscription.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ProviderID" value="{{ $crop->farmer_id }}">
                        <input type="hidden" name="SubscriberID" value="{{ auth()->id() }}">
                        <input type="hidden" name="ProductableType" value="crops">
                        <input type="hidden" name="ProductableID" value="{{ $crop->id }}">
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
                                        ${{ $crop->priceList->price_per_subscription_3 ?? 'N/A' }}</option>
                                    <option value="6">6 Months -
                                        ${{ $crop->priceList->price_per_subscription_6 ?? 'N/A' }}</option>
                                    <option value="9">9 Months -
                                        ${{ $crop->priceList->price_per_subscription_9 ?? 'N/A' }}</option>
                                    <option value="12">12 Months -
                                        ${{ $crop->priceList->price_per_subscription_12 ?? 'N/A' }}</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" id="start_date" name="StartDate" class="form-control"
                                       value="{{ now()->toDateString() }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <p>{{ $crop->farmer_id }}</p>
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
                                    <p class="text-muted">You have <strong>{{ $totalPoints }}</strong> points available.</p>
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
                3: {{ $crop->priceList->price_per_subscription_3 ?? '0' }},
                6: {{ $crop->priceList->price_per_subscription_6 ?? '0' }},
                9: {{ $crop->priceList->price_per_subscription_9 ?? '0' }},
                12: {{ $crop->priceList->price_per_subscription_12 ?? '0' }}
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
