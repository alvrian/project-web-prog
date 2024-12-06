<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">My Waste Catalog</h1>

        <form action="{{ route('waste_log.index') }}" method="GET" class="mb-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by WasteType"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">Filter</button>
                </div>

            </div>
        </form>
        <div class="col-md-2 mt-3 mb-4">
            <a href="{{ route('waste_log.create') }}" class="btn btn-success w-100">Log New Waste</a>
        </div>

        <div class="row">
            @foreach($wasteEntries as $entry)
                <div class="col-md-4 mb-3">
                    <div class="card position-relative">
                        <div class="card-body">
                            <h5 class="card-title">{{ $entry->WasteType }}</h5>
                            <p class="card-text">
                                <strong>Weight:</strong> {{ $entry->Weight }}<br>
                                <strong>Date Logged:</strong> {{ $entry->DateLogged }}<br>
                            </p>
                            <a href="{{ route('waste_log.show', $entry->id) }}" class="btn btn-light">View
                                Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>

<script>
</script>
