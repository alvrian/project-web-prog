<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mb-4">My Available Crops</h1>

        <form action="{{ route('crops.index') }}" method="GET" class="mb-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by name"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="crop_type" class="form-select">
                        <option value="">Select Crop Type</option>
                        <option value="Vegetables" {{ request('crop_type') == 'Vegetables' ? 'selected' : '' }}>
                            Vegetables
                        </option>
                        <option value="Fruits" {{ request('crop_type') == 'Fruits' ? 'selected' : '' }}>Fruits</option>
                        <option value="Grains" {{ request('crop_type') == 'Grains' ? 'selected' : '' }}>Grains</option>
                        <option value="Other" {{ request('crop_type') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-50">Filter</button>
                </div>

            </div>
        </form>
        <div class="col-md-2 mt-3 mb-4">
            <a href="{{ route('crops.create') }}" class="btn btn-success w-70">Insert New Crop</a>
        </div>
        <div class="row">
            @foreach($crops as $crop)
                <div class="col-md-4 mb-3">
                    <div class="card position-relative">
                        @if(!$crop->priceList)
                            <h5><span class="badge bg-danger position-absolute top-0 end-0 m-2"
                                      style="font-weight: normal;">No Price</span></h5>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $crop->crop_name }}</h5>
                            <p class="card-text">
                                <strong>Type:</strong> {{ $crop->crop_type }}<br>
                                <strong>Available:</strong> {{ $crop->availability_start->format('M d, Y') }}
                                - {{ $crop->availability_end->format('M d, Y') }}<br>
                                <strong>Price:</strong>
                                @if($crop->priceList)
                                    {{ $crop->priceList->price_per_item }} per kg
                            <ul>
                                <li>Per Item: ${{ $crop->priceList->price_per_item }}</li>
                                <li>3-Month Subscription: ${{ $crop->priceList->price_per_subscription_3 }}</li>
                                <li>6-Month Subscription: ${{ $crop->priceList->price_per_subscription_6 }}</li>
                                <li>9-Month Subscription: ${{ $crop->priceList->price_per_subscription_9 }}</li>
                                <li>12-Month Subscription: ${{ $crop->priceList->price_per_subscription_12 }}</li>
                            </ul>
                            @else
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#priceModal{{ $crop->id }}">
                                    Set Price
                                </button>
                                @endif
                                </p>
                                @if($crop->priceList)
                                    <button class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#showModal{{ $crop->id }}">
                                        View Details
                                    </button>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $crop->id }}">
                                        Edit
                                    </button>
                                @endif
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="priceModal{{ $crop->id }}" tabindex="-1" aria-labelledby="priceModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="priceModalLabel">Set Price for {{ $crop->crop_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('prices.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="crop_id" value="{{ $crop->id }}">
                                    <div class="mb-3">
                                        <label for="price_per_kg" class="form-label">Price per Kg</label>
                                        <input type="number" name="price_per_kg" class="form-control" min="0"
                                               step="0.01" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Set Price</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal{{ $crop->id }}" tabindex="-1"
                     aria-labelledby="editModalLabel{{ $crop->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $crop->id }}">Edit Crop Entry</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('crops.update', $crop->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="crop_name{{ $crop->id }}" class="form-label">Crop Name</label>
                                        <input type="text" name="crop_name" id="crop_name{{ $crop->id }}"
                                               class="form-control" value="{{ $crop->crop_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="crop_type{{ $crop->id }}" class="form-label">Crop Type</label>
                                        <input type="text" name="crop_type" id="crop_type{{ $crop->id }}"
                                               class="form-control" value="{{ $crop->crop_type }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="availability_start{{ $crop->id }}" class="form-label">Availability
                                            Start</label>
                                        <input type="date" name="availability_start"
                                               id="availability_start{{ $crop->id }}" class="form-control"
                                               value="{{ $crop->availability_start ? $crop->availability_start->format('Y-m-d') : '' }}"
                                               required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="availability_end{{ $crop->id }}" class="form-label">Availability
                                            End</label>
                                        <input type="date" name="availability_end" id="availability_end{{ $crop->id }}"
                                               class="form-control"
                                               value="{{ $crop->availability_end ? $crop->availability_end->format('Y-m-d') : '' }}"
                                               required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_item{{ $crop->id }}" class="form-label">Price Per Item
                                            ($)</label>
                                        <input type="number" name="price_per_item" id="price_per_item{{ $crop->id }}"
                                               class="form-control"
                                               value="{{ optional($crop->priceList)->price_per_item }}" min="0"
                                               step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_3{{ $crop->id }}" class="form-label">3-Month
                                            Subscription ($)</label>
                                        <input type="number" name="price_per_subscription_3"
                                               id="price_per_subscription_3{{ $crop->id }}" class="form-control"
                                               value="{{ optional($crop->priceList)->price_per_subscription_3 }}"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_6{{ $crop->id }}" class="form-label">6-Month
                                            Subscription ($)</label>
                                        <input type="number" name="price_per_subscription_6"
                                               id="price_per_subscription_6{{ $crop->id }}" class="form-control"
                                               value="{{ optional($crop->priceList)->price_per_subscription_6 }}"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_9{{ $crop->id }}" class="form-label">9-Month
                                            Subscription ($)</label>
                                        <input type="number" name="price_per_subscription_9"
                                               id="price_per_subscription_9{{ $crop->id }}" class="form-control"
                                               value="{{ optional($crop->priceList)->price_per_subscription_9 }}"
                                               min="0" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_per_subscription_12{{ $crop->id }}" class="form-label">12-Month
                                            Subscription ($)</label>
                                        <input type="number" name="price_per_subscription_12"
                                               id="price_per_subscription_12{{ $crop->id }}" class="form-control"
                                               value="{{ optional($crop->priceList)->price_per_subscription_12 }}"
                                               min="0" step="0.01" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-success">Update</button>
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
                const formId = form.id;
                const cropId = form.querySelector('input[name="crop_id"]').value;
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
                            document.getElementById('successMessage' + cropId).classList.remove('d-none');
                            document.getElementById('errorMessage' + cropId).classList.add('d-none');
                            setTimeout(() => {
                                document.getElementById('priceModal' + cropId).modal('hide');
                            }, 2000);
                        } else {
                            document.getElementById('errorMessage' + cropId).innerText = data.message;
                            document.getElementById('errorMessage' + cropId).classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('errorMessage' + cropId).innerText = 'An error occurred. Please try again.';
                        document.getElementById('errorMessage' + cropId).classList.remove('d-none');
                    });
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
                            const modal = bootstrap.Modal.getInstance(document.getElementById(`editModal${logId}`));
                            modal.hide();

                            document.querySelector(`#row-${logId} .crop-name`).innerText = formData.get('crop_name');
                            document.querySelector(`#row-${logId} .crop-type`).innerText = formData.get('crop_type');
                            document.querySelector(`#row-${logId} .average-amount`).innerText = formData.get('average_amount') + ' kg';
                            document.querySelector(`#row-${logId} .price-per-kg`).innerText = '$' + formData.get('price_per_kg');

                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                        } else {
                            alert('An error occurred while updating.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An unexpected error occurred.');
                    });
            });
        });

    });
</script>
