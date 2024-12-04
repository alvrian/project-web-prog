<x-layout>
    <x-navbar />

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Compost Producers Available</h1>

        <form action="{{ route('composters.index') }}" method="GET" class="mb-4">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Filter by Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="compost_type" class="form-control" placeholder="Filter by Compost Type" value="{{ request('compost_type') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark w-100">Filter</button>
                    </div>
                </div>
            </div>
        </form>

        @if($compostProducers->isEmpty())
            <div class="alert alert-warning text-center">
                No compost producers found.
            </div>
        @else
            <div class="row">
                @foreach($compostProducers as $producer)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producer->Name }}</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> {{ $producer->Location ?? 'N/A' }}<br>
                                    <strong>Compost Types Produced:</strong>
                                    @if(is_array($types = json_decode($producer->CompostTypesProduced)))
                                        {{ implode(', ', $types) }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                                <a href="{{ route('composters.show', ['composterId' => $producer->id]) }}" class="btn btn-light">View Details</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>

<script>
    console.log(@json($compostProducers));
</script>
