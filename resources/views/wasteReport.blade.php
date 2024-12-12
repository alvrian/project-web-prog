<x-layout>
    <x-navbar/>
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-success bg-opacity-10">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0" style="color: #4b5320;">My Waste Report</h3>
                    <a href="{{ route('waste_log.create') }}" class="btn btn-success">
                        Add New Entry
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date Logged</th>
                            <th>Waste Type</th>
                            <th>Weight (kg)</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($wasteLogs as $log)
                            <tr id="row-{{ $log->id }}">
                                <td>{{ $log->DateLogged->format('M d, Y') }}</td>
                                <td class="waste-type">{{ $log->WasteType }}</td>
                                <td class="weight">{{ number_format($log->Weight, 2) }}</td>
                                <td>
                                    @if($log->priceList)
                                        ${{ number_format($log->priceList->price_per_kg, 2) }} / kg
                                    @else
                                        <span class="badge bg-danger">No Price</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$log->priceList)
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#priceModal{{ $log->id }}">
                                            Set Price
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-light" data-bs-toggle="modal"
                                                data-bs-target="#showModal{{ $log->id }}">
                                            View Details
                                        </button>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $log->id }}">
                                            Edit
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <div class="modal fade" id="priceModal{{ $log->id }}" tabindex="-1"
                                 aria-labelledby="priceModalLabel{{ $log->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="priceModalLabel{{ $log->id }}">
                                                Set Price for {{ $log->WasteType }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="priceForm{{ $log->id }}" action="{{ route('price.store') }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="waste_log_id" value="{{ $log->id }}">
                                                <div class="mb-3">
                                                    <label for="price_per_item{{ $log->id }}" class="form-label">Price
                                                        Per Item</label>
                                                    <input type="number" name="price_per_item"
                                                           id="price_per_item{{ $log->id }}"
                                                           class="form-control" min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_3{{ $log->id }}"
                                                           class="form-label">3-Month Subscription</label>
                                                    <input type="number" name="price_per_subscription_3"
                                                           id="price_per_subscription_3{{ $log->id }}"
                                                           class="form-control"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_6{{ $log->id }}"
                                                           class="form-label">6-Month Subscription</label>
                                                    <input type="number" name="price_per_subscription_6"
                                                           id="price_per_subscription_6{{ $log->id }}"
                                                           class="form-control"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_9{{ $log->id }}"
                                                           class="form-label">9-Month Subscription</label>
                                                    <input type="number" name="price_per_subscription_9"
                                                           id="price_per_subscription_9{{ $log->id }}"
                                                           class="form-control"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_12{{ $log->id }}"
                                                           class="form-label">12-Month Subscription</label>
                                                    <input type="number" name="price_per_subscription_12"
                                                           id="price_per_subscription_12{{ $log->id }}"
                                                           class="form-control"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <button type="submit" class="btn btn-success">Set Price</button>
                                            </form>
                                            <div id="successMessage{{ $log->id }}" class="alert alert-success d-none">
                                                Price set successfully!
                                            </div>
                                            <div id="errorMessage{{ $log->id }}"
                                                 class="alert alert-danger d-none"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editModal{{ $log->id }}" tabindex="-1"
                                 aria-labelledby="editModalLabel{{ $log->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $log->id }}">Edit Waste
                                                Log</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form method="POST" id="editForm{{ $log->id }}"
                                              action="{{ route('waste_log.update', $log->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="WasteType{{ $log->id }}" class="form-label">Waste
                                                        Type</label>
                                                    <input type="text" name="WasteType" id="WasteType{{ $log->id }}"
                                                           class="form-control" value="{{ $log->WasteType }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Weight{{ $log->id }}" class="form-label">Weight
                                                        (kg)</label>
                                                    <input type="number" name="Weight" id="Weight{{ $log->id }}"
                                                           class="form-control" value="{{ $log->Weight }}" min="0"
                                                           step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_item{{ $log->id }}" class="form-label">Price
                                                        Per Item</label>
                                                    <input type="number" name="price_per_item"
                                                           id="price_per_item{{ $log->id }}"
                                                           class="form-control"
                                                           value="{{ optional($log->priceList)->price_per_kg }}"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_3{{ $log->id }}"
                                                           class="form-label">3-Month Subscription</label>
                                                    <input type="number" name="price_per_subscription_3"
                                                           id="price_per_subscription_3{{ $log->id }}"
                                                           class="form-control"
                                                           value="{{ optional($log->priceList)->price_per_subscription_3 }}"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_6{{ $log->id }}"
                                                           class="form-label">6-Month Subscription</label>
                                                    <input type="number" name="price_per_subscription_6"
                                                           id="price_per_subscription_6{{ $log->id }}"
                                                           class="form-control"
                                                           value="{{ optional($log->priceList)->price_per_subscription_6 }}"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_9{{ $log->id }}"
                                                           class="form-label">9-Month Subscription</label>
                                                    <input type="number" name="price_per_subscription_9"
                                                           id="price_per_subscription_9{{ $log->id }}"
                                                           class="form-control"
                                                           value="{{ optional($log->priceList)->price_per_subscription_9 }}"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_12{{ $log->id }}"
                                                           class="form-label">12-Month Subscription</label>
                                                    <input type="number" name="price_per_subscription_12"
                                                           id="price_per_subscription_12{{ $log->id }}"
                                                           class="form-control"
                                                           value="{{ optional($log->priceList)->price_per_subscription_12 }}"
                                                           min="0" step="0.01" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    <span id="spinner{{ $log->id }}"
                                                          class="spinner-border spinner-border-sm d-none" role="status"
                                                          aria-hidden="true"></span>
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="showModal{{ $log->id }}" tabindex="-1"
                                 aria-labelledby="showModalLabel{{ $log->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="showModalLabel{{ $log->id }}">
                                                Waste Log Details
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Details</h4>
                                            <p class="card-text">
                                                <strong>Weight:</strong> {{ $log->Weight }} kg<br>
                                                <strong>Date Logged:</strong> {{ $log->DateLogged->format('M d, Y') }}
                                                <br>
                                                <strong>Waste Type:</strong> {{ $log->WasteType }}<br>
                                            </p>

                                            @if($log->priceList)
                                                <h5>Pricing</h5>
                                                <p>
                                                    <strong>Price Per Item:</strong>
                                                    ${{ number_format($log->priceList->price_per_kg, 2) }}<br>
                                                    <strong>3-Month Subscription:</strong>
                                                    ${{ number_format($log->priceList->price_per_subscription_3, 2) }}
                                                    <br>
                                                    <strong>6-Month Subscription:</strong>
                                                    ${{ number_format($log->priceList->price_per_subscription_6, 2) }}
                                                    <br>
                                                    <strong>9-Month Subscription:</strong>
                                                    ${{ number_format($log->priceList->price_per_subscription_9, 2) }}
                                                    <br>
                                                    <strong>12-Month Subscription:</strong>
                                                    ${{ number_format($log->priceList->price_per_subscription_12, 2) }}
                                                    <br>
                                                </p>
                                            @else
                                                <p><strong>Price:</strong> <span class="badge bg-danger">No Price</span>
                                                </p>
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

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No waste logs found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $wasteLogs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form[id^="priceForm"]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const logId = form.querySelector('input[name="waste_log_id"]').value;
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
                            document.getElementById('successMessage' + logId).classList.remove('d-none');
                            document.getElementById('errorMessage' + logId).classList.add('d-none');
                            setTimeout(() => {
                                const modal = new bootstrap.Modal(document.getElementById('priceModal' + logId));
                                modal.hide();
                                location.reload();
                            }, 2000);
                        } else {
                            document.getElementById('errorMessage' + logId).innerText = data.message;
                            document.getElementById('errorMessage' + logId).classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('errorMessage' + logId).innerText = 'An error occurred. Please try again.';
                        document.getElementById('errorMessage' + logId).classList.remove('d-none');
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

</script>
