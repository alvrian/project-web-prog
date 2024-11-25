<x-layout>
    <x-navbar/>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6">
            <form id="wasteForm" class="p-4 rounded shadow" style="background-color: #f9f9f9;">
                <h3 class="text-center mb-4" style="color: #4b5320;">Log Waste Entry</h3>

                <div class="mb-3">
                    <label for="restaurantId" class="form-label">Restaurant ID</label>
                    <input type="text" class="form-control" id="restaurantId" placeholder="Enter Restaurant ID" required>
                </div>
                
                <div class="mb-3">
                    <label for="wasteType" class="form-label">Waste Type</label>
                    <select class="form-select" id="wasteType" required>
                        <option value="" disabled selected>Select Waste Type</option>
                        <option value="Food Waste">Food Waste</option>
                        <option value="Plastic Waste">Plastic Waste</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Weight (kg)</label>
                    <input type="number" class="form-control" id="weight" placeholder="Enter Weight" required>
                </div>
                
                <div class="mb-3">
                    <label for="dateLogged" class="form-label">Date Logged</label>
                    <input type="date" class="form-control" id="dateLogged" required>
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#confirmationModal">Submit</button>
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
                    Are you sure you want to submit this data?
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmSubmit" class="btn btn-success">Yes, Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('confirmSubmit').addEventListener('click', function () {
            document.getElementById('wasteForm').submit();
        });
    </script>
</x-layout>
