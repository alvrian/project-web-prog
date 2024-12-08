<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Restaurant Owners</h1>

        <form action="{{ route('resto-owners.index') }}" method="GET" class="mb-4">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="restaurant_name" class="form-control" placeholder="Filter by Restaurant Name"
                               value="{{ request('restaurant_name') }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="waste_type" class="form-control" placeholder="Filter by Waste Type"
                               value="{{ request('waste_type') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark w-100">Filter</button>
                    </div>
                </div>
            </div>
        </form>

        @if($restaurantOwners->isEmpty())
            <div class="alert alert-warning text-center">
                No restaurant owners found.
            </div>
        @else
            <div class="row">
                @foreach($restaurantOwners as $owner)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $owner->Name }}</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> {{ $owner->Location ?? 'N/A' }}<br>
                                    <strong>Type:</strong> {{ $owner->Type ?? 'N/A' }}<br>
                                    <strong>Average Waste:</strong> {{ $owner->AverageFoodWastePerMonth ?? 'N/A' }} kg/month<br>
                                </p>
                                <a href="{{ route('resto-owners.show', ['ownerID' => $owner->user_id]) }}" class="btn btn-light">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif


    @if(session('success'))
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="toastSuccess" class="toast align-items-center text-bg-success" role="alert"
                     aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var toastElement = document.getElementById('toastSuccess');
                    if (toastElement) {
                        var toast = new bootstrap.Toast(toastElement);
                        toast.show();
                    }
                });
            </script>
        @endif
    </div>
</x-layout>
