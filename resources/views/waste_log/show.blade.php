<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mb-4">Waste Log Details</h1>

        <div class="row">
            <div class="col-md-6">
                <h4>Details</h4>
                <p class="card-text">
                    <strong>Weight:</strong> {{ $entry->Weight }}<br>
                    <strong>Date Logged:</strong> {{ $entry->DateLogged }}<br>
                </p>
                <a href="{{ route('waste_log.index') }}" class="btn btn-light">Back</a>
                <a href="{{ route('waste_log.edit', $entry->id) }}" class="btn btn-warning">Edit</a>
                <a class="btn btn-success">Subscribe</a>
            </div>
        </div>
    </div>
</x-layout>

<script>
    console.log(@json($entry));
</script>
