<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">My Compost Catalog</h1>

        <form action="{{ route('compost.index') }}" method="GET" class="mb-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Compost Type (e.g., Manure-Based Compost)"
                           value="{{ request('search') }}">
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
                                    <button class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#showModal{{ $entry->id }}">
                                        View Details
                                    </button>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $entry->id }}">
                                        Edit
                                    </button>
                                @endif
                                <script>
                                    console.log(@json($entry));
                                </script>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="showModal{{ $entry->id }}" tabindex="-1"
                     aria-labelledby="showModalLabel{{ $entry->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="showModalLabel{{ $entry->id }}">
                                    Compost Entry Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Compost Details</h4>
                                <p class="card-text">
                                    <strong>Compost Type:</strong> {{ $entry->compost_types_produced }}<br>
                                    <strong>Average
                                        Amount:</strong> {{ number_format($entry->average_compost_amount, 2) }} kg<br>
                                    <strong>Kitchen Waste
                                        Capacity:</strong> {{ number_format($entry->kitchen_waste_capacity, 2) }} kg<br>
                                    <strong>Date
                                        Logged:</strong> {{ $entry->date_logged ? $entry->date_logged->format('M d, Y') : 'Not Logged' }}
                                </p>

                                @if($entry->priceList)
                                    <h5>Pricing Details</h5>
                                    <p>
                                        <strong>Price Per Item:</strong>
                                        ${{ number_format($entry->priceList->price_per_item, 2) }}<br>
                                        <strong>3-Month Subscription:</strong>
                                        ${{ number_format($entry->priceList->price_per_subscription_3, 2) }}<br>
                                        <strong>6-Month Subscription:</strong>
                                        ${{ number_format($entry->priceList->price_per_subscription_6, 2) }}<br>
                                        <strong>9-Month Subscription:</strong>
                                        ${{ number_format($entry->priceList->price_per_subscription_9, 2) }}<br>
                                        <strong>12-Month Subscription:</strong>
                                        ${{ number_format($entry->priceList->price_per_subscription_12, 2) }}<br>
                                    </p>
                                @else
                                    <p><strong>Price:</strong> <span class="badge bg-danger">No Price Set</span></p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
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
                                <form id="priceForm{{ $entry->id }}"
                                      action="{{ route('compost-price.store', ['id' => $entry->id]) }}" method="POST">
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

                <div class="modal fade" id="editModal{{ $entry->id }}" tabindex="-1"
                     aria-labelledby="editModalLabel{{ $entry->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $entry->id }}">Edit Compost Entry</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form method="POST" id="editForm{{ $entry->id }}"
                                  action="{{ route('compost.update', $entry->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="compost_producer_name{{ $entry->id }}" class="form-label">Producer
                                            Name</label>
                                        <input type="text" name="compost_producer_name"
                                               id="compost_producer_name{{ $entry->id }}" class="form-control"
                                               value="{{ $entry->compost_producer_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="compost_types_produced{{ $entry->id }}" class="form-label">Type of
                                            Compost Produced</label>
                                        <input type="text" name="compost_types_produced"
                                               id="compost_types_produced{{ $entry->id }}" class="form-control"
                                               value="{{ $entry->compost_types_produced }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="average_compost_amount{{ $entry->id }}" class="form-label">Average
                                            Amount (kg)</label>
                                        <input type="number" name="average_compost_amount"
                                               id="average_compost_amount{{ $entry->id }}" class="form-control"
                                               value="{{ $entry->average_compost_amount }}" min="0" step="0.01"
                                               required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kitchen_waste_capacity{{ $entry->id }}" class="form-label">Kitchen
                                            Waste Capacity (kg)</label>
                                        <input type="number" name="kitchen_waste_capacity"
                                               id="kitchen_waste_capacity{{ $entry->id }}" class="form-control"
                                               value="{{ $entry->kitchen_waste_capacity }}" min="0" step="0.01"
                                               required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_logged{{ $entry->id }}" class="form-label">Date Logged</label>
                                        <input type="date" name="date_logged" id="date_logged{{ $entry->id }}"
                                               class="form-control"
                                               value="{{ $entry->date_logged ? $entry->date_logged->format('Y-m-d') : '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_item{{ $entry->id }}" class="form-label">Price Per Item
                                            ($)</label>
                                        <input type="number" name="price_per_item" id="price_per_item{{ $entry->id }}"
                                               class="form-control"
                                               value="{{ optional($entry->priceList)->price_per_item }}" min="0"
                                               step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_3{{ $entry->id }}" class="form-label">3-Month
                                            Subscription ($)</label>
                                        <input type="number" name="price_per_subscription_3"
                                               id="price_per_subscription_3{{ $entry->id }}" class="form-control"
                                               value="{{ optional($entry->priceList)->price_per_subscription_3 }}"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_6{{ $entry->id }}" class="form-label">6-Month
                                            Subscription ($)</label>
                                        <input type="number" name="price_per_subscription_6"
                                               id="price_per_subscription_6{{ $entry->id }}" class="form-control"
                                               value="{{ optional($entry->priceList)->price_per_subscription_6 }}"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_9{{ $entry->id }}" class="form-label">9-Month
                                            Subscription ($)</label>
                                        <input type="number" name="price_per_subscription_9"
                                               id="price_per_subscription_9{{ $entry->id }}" class="form-control"
                                               value="{{ optional($entry->priceList)->price_per_subscription_9 }}"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_12{{ $entry->id }}" class="form-label">12-Month
                                            Subscription ($)</label>
                                        <input type="number" name="price_per_subscription_12"
                                               id="price_per_subscription_12{{ $entry->id }}" class="form-control"
                                               value="{{ optional($entry->priceList)->price_per_subscription_12 }}"
                                               min="0" step="0.01" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <span id="spinner{{ $entry->id }}"
                                              class="spinner-border spinner-border-sm d-none" role="status"
                                              aria-hidden="true"></span>
                                        Update
                                    </button>
                                </div>
                            </form>
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
                fetch('/compost-producer/prices/' + compostId, {
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

            document.querySelectorAll('form[id^="editForm"]').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const formData = new FormData(form);
                    const logId = form.action.split('/').pop();
                    const url = form.action;

                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const modal = new bootstrap.Modal(document.getElementById(`editModal${logId}`));
                                modal.hide();

                                document.querySelector(`#row-${logId} .waste-type`).innerText = formData.get('WasteType');
                                document.querySelector(`#row-${logId} .weight`).innerText = formData.get('Weight') + ' kg';

                                window.location.href = data.redirect || `/waste_log.list?restaurantOwnerID=${encodeURIComponent(auth()->id())}`;
                            } else {
                                alert('An error occurred while updating.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

        });
</script>
