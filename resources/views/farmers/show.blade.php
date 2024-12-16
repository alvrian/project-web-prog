<x-layout>
    <x-navbar/>
    <div class="d-flex justify-content-center align-items-center"
         style="background-color: #43553D;height:93vh;font-family:&quot;Inter&quot;, serif;">
        <div style="background-color: white; min-height: 80vh;width:95%; border-radius: 12px;padding:1rem;">

            <div class="container">
                <h1 class="text-center mt-4 mb-4">{{ $farmer->Name }}</h1>
                <p><strong>Location:</strong> {{ $farmer->Location ?? 'N/A' }}</p>
                <p><strong>Crop Types Produced:</strong> {{ $farmer->CropTypesProduced ?? 'N/A' }}</p>
                <p><strong>Harvest Schedule:</strong> {{ $farmer->HarvestSchedule ?? 'N/A' }}</p>

                <h2 class="mt-4">Available Crops</h2>
                @if($crops->isEmpty())
                    <div class="alert alert-warning text-center">
                        No crops available.
                    </div>
                @else
                    <div class="row">
                        @foreach($crops as $crop)
                            <div class="col-md-4 mb-3">
                                <div class="card position-relative card border-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $crop->crop_name }}</h5>
                                        <p class="card-text">
                                            <strong>Type:</strong> {{ $crop->crop_type }}<br>
                                            <strong>Average Amount:</strong> {{ $crop->average_amount ?? 'N/A' }} kg<br>
                                            <strong>Harvest Cycles:</strong> {{ $crop->harvest_cycles ?? 'N/A' }}<br>
                                            <strong>Available
                                                From:</strong> {{ $crop->availability_start?->format('Y-m-d') ?? 'N/A' }}
                                            <br>
                                            <strong>Available
                                                To:</strong> {{ $crop->availability_end?->format('Y-m-d') ?? 'N/A' }}
                                        </p>
                                        <a href="{{ route('farmers.show-detail', ['farmerId' => $farmer->user_id, 'cropId' => $crop->id]) }}"
                                           class="btn btn-dark">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
