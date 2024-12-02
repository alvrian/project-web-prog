<x-layout>
    <x-navbar />
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f0f0e4;">
        <div class="col-md-6">
            <form id="cropForm" method="POST" action="{{ route('crop.store') }}" enctype="multipart/form-data" class="p-4 rounded shadow" style="background-color: #f9f9f9;">
                @csrf
                <h3 class="text-center mb-4" style="color: #4b5320;">Log Crop Data</h3>
                <a href="{{ route('crops.index') }}" class="btn btn-light">Back</a>

                <div class="mb-3">
                    <label for="farmerId" class="form-label">Farmer ID</label>
                    <input type="text" id="farmerId" class="form-control" value="{{ auth()->user()->id }}" disabled>
                    <input type="hidden" name="farmer_id" value="{{ auth()->user()->id }}">
                </div>

                <div class="mb-3">
                    <label for="farmerName" class="form-label">Farmer Name</label>
                    <input type="text" id="farmerName" class="form-control" value="{{ auth()->user()->name }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="cropName" class="form-label">Crop Name</label>
                    <input type="text" class="form-control" id="cropName" name="crop_name" placeholder="Enter crop name" required>
                    <small class="text-danger d-none" id="cropNameError">Please enter a crop name.</small>
                </div>

                <div class="mb-3">
                    <label for="cropType" class="form-label">Crop Type</label>
                    <select class="form-select" id="cropType" name="crop_type" required>
                        <option value="" disabled selected>Select Crop Type</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Grains">Grains</option>
                        <option value="Other">Other</option>
                    </select>
                    <small class="text-danger d-none" id="cropTypeError">Please select a crop type.</small>
                </div>

                <div class="mb-3">
                    <label for="averageAmount" class="form-label">Average Amount Harvested (kg)</label>
                    <input type="number" class="form-control" id="averageAmount" name="average_amount" placeholder="Enter average amount harvested" required>
                    <small class="text-danger d-none" id="averageAmountError">Please enter the average amount.</small>
                </div>

                <div class="mb-3">
                    <label for="harvestCycles" class="form-label">Harvest Cycles per Year</label>
                    <input type="number" class="form-control" id="harvestCycles" name="harvest_cycles" placeholder="Enter the number of harvest cycles" required>
                    <small class="text-danger d-none" id="harvestCyclesError">Please enter the number of harvest cycles.</small>
                </div>

                <div class="mb-3">
                    <label for="cropImage" class="form-label">Upload Crop Picture</label>
                    <input type="file" class="form-control" id="cropImage" name="crop_image" accept="image/*" required>
                    <small class="text-danger d-none" id="cropImageError">Please upload a valid image file.</small>
                </div>

                <div class="mb-3">
                    <label for="availabilityStart" class="form-label">Availability Start Date</label>
                    <input type="date" class="form-control" id="availabilityStart" name="availability_start" required>
                    <small class="text-danger d-none" id="availabilityStartError">Please enter the availability start date.</small>
                </div>

                <div class="mb-3">
                    <label for="availabilityEnd" class="form-label">Availability End Date</label>
                    <input type="date" class="form-control" id="availabilityEnd" name="availability_end" required>
                    <small class="text-danger d-none" id="availabilityEndError">Please enter the availability end date.</small>
                </div>

                <div class="text-center">
                    <button type="button" id="submitBtn" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#confirmationModal" disabled>Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit this crop data?
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmSubmit" class="btn btn-success">Yes, Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('cropForm');
        const submitBtn = document.getElementById('submitBtn');
        const fields = {
            cropName: document.getElementById('cropName'),
            cropType: document.getElementById('cropType'),
            averageAmount: document.getElementById('averageAmount'),
            harvestCycles: document.getElementById('harvestCycles'),
            cropImage: document.getElementById('cropImage'),
            availabilityStart: document.getElementById('availabilityStart'),
            availabilityEnd: document.getElementById('availabilityEnd'),
        };
        const errors = {
            cropName: document.getElementById('cropNameError'),
            cropType: document.getElementById('cropTypeError'),
            averageAmount: document.getElementById('averageAmountError'),
            harvestCycles: document.getElementById('harvestCyclesError'),
            cropImage: document.getElementById('cropImageError'),
            availabilityStart: document.getElementById('availabilityStartError'),
            availabilityEnd: document.getElementById('availabilityEndError'),
        };

        const validateForm = () => {
            let isValid = true;
            for (let field in fields) {
                if (!fields[field].value) {
                    errors[field].classList.remove('d-none');
                    isValid = false;
                } else {
                    errors[field].classList.add('d-none');
                }
            }
            submitBtn.disabled = !isValid;
        };

        Object.values(fields).forEach(input => {
            input.addEventListener('input', validateForm);
        });

        document.getElementById('confirmSubmit').addEventListener('click', function () {
            form.submit();
        });
    </script>
</x-layout>
