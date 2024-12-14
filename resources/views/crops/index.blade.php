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
            <a href="{{ route('crop.create') }}" class="btn btn-success w-70">Insert New Crop</a>
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
                                <a href="{{ route('crops.show', $crop->id) }}" class="btn btn-light">View Details</a>
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
    });
</script>
