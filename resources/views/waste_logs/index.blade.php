<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Waste Logs</h1>

        <form action="{{ route('resto-owners.index') }}" method="GET" class="mb-4">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="restaurant_name" class="form-control" placeholder="Filter by Restaurant"
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

        @if($wasteLogs->isEmpty())
            <div class="alert alert-warning text-center">
                No waste logs found.
            </div>
        @else
            <div class="row">
                @foreach($wasteLogs as $log)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Waste Type: {{ $log->WasteType }}</h5>
                                <p class="card-text">
                                    <strong>Weight:</strong> {{ $log->Weight }} kg<br>
                                    <strong>Date Logged:</strong> {{ $log->DateLogged }}<br>
                                    <strong>Restaurant:</strong> {{ $log->restaurantOwner->name ?? 'N/A' }}
                                </p>
                                <a href="{{ route('wastelogs.show', ['id' => $log->id]) }}" class="btn btn-light">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
