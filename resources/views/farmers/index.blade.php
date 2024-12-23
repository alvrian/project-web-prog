<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Farmers Available</h1>

        <form action="{{ route('farmers.index') }}" method="GET" class="mb-4">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Filter by Name"
                               value="{{ request('name') }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Filter</button>
                    </div>
                </div>
            </div>
        </form>

        @if($farmers->isEmpty())
            <div class="alert alert-warning text-center">
                No farmers found.
            </div>
        @else
            <div class="row">
                @foreach($farmers as $farmer)
                    <div class="col-md-4 mb-3">
                        <div class="card position-relative card border-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $farmer->Name }}</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> {{ $farmer->Location ?? 'N/A' }}<br>
                                    <strong>Crop Types Produced: </strong>{{ $farmer->CropTypesProduced ?? 'N/A' }}

                                </p>
                                <a href="{{ route('farmers.show', ['farmerId' => $farmer->user_id]) }}"
                                   class="btn btn-dark">View Details</a>
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
