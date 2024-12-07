<x-layout>
    <x-navbar />

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
                    <strong>Price:</strong> ${{ $crop->prices->price_per_unit ?? 'N/A' }}
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
                                    <option value="3">3 Months - ${{ $crop->prices->price_per_subscription_3 ?? 'N/A' }}</option>
                                    <option value="6">6 Months - ${{ $crop->prices->price_per_subscription_6 ?? 'N/A' }}</option>
                                    <option value="9">9 Months - ${{ $crop->prices->price_per_subscription_9 ?? 'N/A' }}</option>
                                    <option value="12">12 Months - ${{ $crop->prices->price_per_subscription_12 ?? 'N/A' }}</option>
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
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
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

            const prices = {
                3: {{ $crop->prices->price_per_subscription_3 ?? '0' }},
                6: {{ $crop->prices->price_per_subscription_6 ?? '0' }},
                9: {{ $crop->prices->price_per_subscription_9 ?? '0' }},
                12: {{ $crop->prices->price_per_subscription_12 ?? '0' }}
            };

            subscriptionTypeSelect.addEventListener('change', function () {
                const selectedOption = this.value;
                const price = prices[selectedOption] || 0;

                priceInput.value = `$${price.toFixed(2)}`;

                const startDate = new Date(startDateInput.value);
                if (selectedOption) {
                    startDate.setMonth(startDate.getMonth() + parseInt(selectedOption));
                    endDateInput.value = startDate.toISOString().split('T')[0];
                }
            });
        });
    </script>
</x-layout>
