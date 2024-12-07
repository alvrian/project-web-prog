<x-layout>
    <x-navbar/>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Waste Log Details</h1>
        <p><strong>Restaurant:</strong> {{ $wasteLog->restaurantOwner->name ?? 'N/A' }}</p>
        <p><strong>Waste Type:</strong> {{ $wasteLog->WasteType }}</p>
        <p><strong>Weight:</strong> {{ $wasteLog->Weight }} kg</p>
        <p><strong>Date Logged:</strong> {{ $wasteLog->DateLogged }}</p>

        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('wastelogs.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
</x-layout>
