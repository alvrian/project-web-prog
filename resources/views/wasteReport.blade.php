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
                            <tr>
                                <td>{{ $log->DateLogged->format('M d, Y') }}</td>
                                <td>{{ $log->WasteType }}</td>
                                <td>{{ number_format($log->Weight, 2) }}</td>
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
                                        <a href="{{ route('waste_log.show', $log->id) }}" class="btn btn-sm btn-light">
                                            View Details
                                        </a>
                                    @endif
                                </td>
                            </tr>

                            <div class="modal fade" id="priceModal{{ $log->id }}" tabindex="-1"
                                 aria-labelledby="priceModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="priceModalLabel">
                                                Set Price for {{ $log->WasteType }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="priceForm{{ $log->id }}" action="{{ route('price.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="waste_log_id" value="{{ $log->id }}">
                                                <div class="mb-3">
                                                    <label for="price_per_item" class="form-label">Price Per
                                                        Item</label>
                                                    <input type="number" name="price_per_item" class="form-control"
                                                           min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_3" class="form-label">3-Month
                                                        Subscription</label>
                                                    <input type="number" name="price_per_subscription_3"
                                                           class="form-control" min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_6" class="form-label">6-Month
                                                        Subscription</label>
                                                    <input type="number" name="price_per_subscription_6"
                                                           class="form-control" min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_9" class="form-label">9-Month
                                                        Subscription</label>
                                                    <input type="number" name="price_per_subscription_9"
                                                           class="form-control" min="0" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price_per_subscription_12" class="form-label">12-Month
                                                        Subscription</label>
                                                    <input type="number" name="price_per_subscription_12"
                                                           class="form-control" min="0" step="0.01" required>
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
                                location.reload(); // Reload to update the price in the table
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
    });
</script>
