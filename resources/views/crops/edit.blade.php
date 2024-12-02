<x-layout>
    <x-navbar/>
    <div class="container mt-5">
        <h1 class="text-center">Edit Crop</h1>
        <form action="{{ route('crops.update', $crop->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="crop_name">Crop Name</label>
                        <input type="text" name="crop_name" id="crop_name" class="form-control" value="{{ old('crop_name', $crop->crop_name) }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="crop_type">Crop Type</label>
                        <select name="crop_type" id="crop_type" class="form-select" required>
                            <option value="Vegetables" {{ $crop->crop_type == 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
                            <option value="Fruits" {{ $crop->crop_type == 'Fruits' ? 'selected' : '' }}>Fruits</option>
                            <option value="Grains" {{ $crop->crop_type == 'Grains' ? 'selected' : '' }}>Grains</option>
                            <option value="Other" {{ $crop->crop_type == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="average_amount">Average Amount (kg)</label>
                        <input type="number" name="average_amount" id="average_amount" class="form-control" value="{{ old('average_amount', $crop->average_amount) }}" min="0" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="crop_image">Crop Image</label>
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $crop->crop_image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                        <input type="file" name="crop_image" id="crop_image" class="form-control">
                        <small class="form-text text-muted">Leave blank to keep the current image.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="harvest_cycles">Harvest Cycles</label>
                        <input type="number" name="harvest_cycles" id="harvest_cycles" class="form-control" value="{{ old('harvest_cycles', $crop->harvest_cycles) }}" min="1" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price_per_kg">Price (per kg)</label>
                        <input type="number" name="price_per_kg" id="price_per_kg" class="form-control" value="{{ old('price_per_kg', optional($crop->prices)->price_per_kg) }}" min="0" step="0.01" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="availability_start">Availability Start</label>
                        <input type="date" name="availability_start" id="availability_start" class="form-control" value="{{ old('availability_start', $crop->availability_start->toDateString()) }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="availability_end">Availability End</label>
                        <input type="date" name="availability_end" id="availability_end" class="form-control" value="{{ old('availability_end', $crop->availability_end->toDateString()) }}" required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('crops.show', $crop->id) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>
    </div>
</x-layout>
