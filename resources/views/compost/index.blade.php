<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">My Compost Catalog</h1>

        <form action="{{ route('compost.index') }}" method="GET" class="mb-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by Producer Name"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="compost_type" class="form-control"
                           placeholder="Compost Type (e.g., Vermicompost)" value="{{ request('compost_type') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">Filter</button>
                </div>

            </div>
        </form>
        <div class="col-md-2 mt-3 mb-4">
            <a href="{{ route('compost.create') }}" class="btn btn-success w-100">Add New Compost</a>
        </div>

        <div class="row">
            @foreach($compostEntries as $entry)
                <div class="col-md-4 mb-3">
                    <div class="card position-relative">
                        @if(!$entry->priceList)
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">No Price</span>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $entry->compost_producer_name }}</h5>
                            <p class="card-text">
                                <strong>Compost Type:</strong> {{ $entry->compost_types_produced }}<br>
                                <strong>Average Amount:</strong> {{ $entry->average_compost_amount }} kg<br>
                                <strong>Kitchen Waste Capacity:</strong> {{ $entry->kitchen_waste_capacity }} kg<br>
                                <strong>Date Logged:</strong> {{ $entry->date_logged->format('M d, Y') }}<br>
                                <strong>Price:</strong>
                            @if($entry->priceList)
                                <ul>
                                    <li>Per Item: ${{ $entry->priceList->price_per_item }}</li>
                                    <li>3-Month Subscription: ${{ $entry->priceList->price_per_subscription_3 }}</li>
                                    <li>6-Month Subscription: ${{ $entry->priceList->price_per_subscription_6 }}</li>
                                    <li>9-Month Subscription: ${{ $entry->priceList->price_per_subscription_9 }}</li>
                                    <li>12-Month Subscription: ${{ $entry->priceList->price_per_subscription_12 }}</li>
                                </ul>
                            @else
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#priceModal{{ $entry->id }}">
                                    Set Price
                                </button>
                                @endif
                                </p>
                                @if($entry->priceList)
                                    <a href="{{ route('compost.show', $entry->id) }}" class="btn btn-light">View
                                        Details</a>
                                @endif
                                <script>
                                    console.log(@json($entry));
                                </script>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="priceModal{{ $entry->id }}" tabindex="-1" aria-labelledby="priceModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="priceModalLabel">Set Price
                                    for {{ $entry->compost_types_produced }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="priceForm{{ $entry->id }}" action="{{ route('price.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="compost_entry_id" value="{{ $entry->id }}">
                                    <div class="mb-3">
                                        <label for="price_per_item" class="form-label">Price Per Item</label>
                                        <input type="number" name="price_per_item" class="form-control" min="0"
                                               step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_3" class="form-label">3-Month
                                            Subscription</label>
                                        <input type="number" name="price_per_subscription_3" class="form-control"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_6" class="form-label">6-Month
                                            Subscription</label>
                                        <input type="number" name="price_per_subscription_6" class="form-control"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_9" class="form-label">9-Month
                                            Subscription</label>
                                        <input type="number" name="price_per_subscription_9" class="form-control"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_12" class="form-label">12-Month
                                            Subscription</label>
                                        <input type="number" name="price_per_subscription_12" class="form-control"
                                               min="0" step="0.01" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Set Price</button>
                                </form>
                                <div id="successMessage{{ $entry->id }}" class="alert alert-success d-none">Price set
                                    successfully!
                                </div>
                                <div id="errorMessage{{ $entry->id }}" class="alert alert-danger d-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form[id^="priceForm"]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const compostId = form.querySelector('input[name="compost_entry_id"]').value;
                const formData = new FormData(form);
                fetch('/prices', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('successMessage' + compostId).classList.remove('d-none');
                            document.getElementById('errorMessage' + compostId).classList.add('d-none');
                            setTimeout(() => {
                                const modal = new bootstrap.Modal(document.getElementById('priceModal' + compostId));
                                modal.hide();
                            }, 2000);
                        } else {
                            document.getElementById('errorMessage' + compostId).innerText = data.message;
                            document.getElementById('errorMessage' + compostId).classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('errorMessage' + compostId).innerText = 'An error occurred. Please try again.';
                        document.getElementById('errorMessage' + compostId).classList.remove('d-none');
                    });
            });
        });
    });
</script>
