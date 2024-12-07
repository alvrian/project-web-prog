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
                    <div class="col-md-4">
                        <input type="text" name="crop_type" class="form-control" placeholder="Filter by Crop Type"
                               value="{{ request('crop_type') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark w-100">Filter</button>
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
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $farmer->Name }}</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> {{ $farmer->Location ?? 'N/A' }}<br>
                                    <strong>Crop Types Produced:</strong>
                                    @if(is_array($types = json_decode($farmer->CropTypesProduced)))
                                        {{ implode(', ', $types) }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                                <a href="{{ route('farmers.show', ['farmerId' => $farmer->user_id]) }}"
                                   class="btn btn-light">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
