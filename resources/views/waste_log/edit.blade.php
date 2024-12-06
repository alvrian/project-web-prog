<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Edit Waste Log</h1>

        <form method="POST" action="{{ route('waste_log.update', $entry->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="WasteType" class="form-label">Waste Type</label>
                <input
                    type="text"
                    name="WasteType"
                    id="WasteType"
                    class="form-control"
                    value="{{ old('WasteType', $entry->WasteType) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="Weight" class="form-label">Weight (kg)</label>
                <input
                    type="number"
                    name="Weight"
                    id="Weight"
                    class="form-control"
                    value="{{ old('Weight', $entry->Weight) }}"
                    required
                    min="0"
                    step="0.01">
            </div>

            <div class="text-center mt-4 mb-4">
                <a href="{{ route('waste_log.show', $entry->id) }}"
                   class="btn btn-secondary me-3">Cancel</a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>

        </form>
    </div>
</x-layout>
