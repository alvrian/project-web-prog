<x-layout>
    <x-navbar/>
    <div class="container d-flex justify-content-center align-items-center"
         style="min-height: 100vh; background-color: #f0f0e4;">
        <div class="col-md-6">
            <form id="compostForm" method="POST" action="{{ route('compost.store') }}" class="p-4 rounded shadow"
                  style="background-color: #f9f9f9;">
                <button type="button" class="btn btn-light w-auto" onclick="window.history.back()">Back</button>
                @csrf
                <h3 class="text-center mb-4" style="color: #4b5320;">Log Compost Data</h3>

                <div class="mb-3">
                    <input type="hidden" name="compost_producer_id" value="{{ auth()->user()->id }}">
                </div>

                <div class="mb-3">
                    <label for="CompostTypesProduced" class="form-label">Compost Type</label>
                    <select class="form-select" id="CompostTypesProduced" name="compost_types_produced" required>
                        <option value="" disabled selected>Select Compost Type</option>
                        <option value="Green Compost">Green Compost</option>
                        <option value="Brown Compost">Brown Compost</option>
                        <option value="Manure-Based Compost">Manure-Based Compost</option>
                        <option value="Mushroom Compost">Mushroom Compost</option>
                        <option value="Humus Compost">Mushroom Compost</option>
                        <option value="Other">Other</option>
                    </select>
                    <small class="text-danger d-none" id="compostTypeError">Please select a compost type.</small>
                </div>


                <div class="mb-3">
                    <label for="averageCompost" class="form-label">Average Amount Produced (kg)</label>
                    <input type="number" class="form-control" id="averageCompost" name="average_compost_amount"
                           placeholder="Enter average amount per term" required>
                    <small class="text-danger d-none" id="averageCompostError">Please enter the average amount.</small>
                </div>


                <div class="mb-3">
                    <label for="kitchenWasteCapacity" class="form-label">Kitchen Waste Processing Capacity (kg)</label>
                    <input type="number" class="form-control" id="kitchenWasteCapacity" name="kitchen_waste_capacity"
                           placeholder="Enter processing capacity per term" required>
                    <small class="text-danger d-none" id="kitchenWasteCapacityError">Please enter the processing
                        capacity.</small>
                </div>


                <div class="mb-3">
                    <label for="dateLogged" class="form-label">Date Logged</label>
                    <input type="date" class="form-control" id="dateLogged" name="date_logged"
                           value="{{ now()->format('Y-m-d') }}" required>
                    <small class="text-danger d-none" id="dateLoggedError">Please enter a valid date.</small>
                </div>

                <div class="text-center">
                    <button type="button" id="submitBtn" class="btn btn-success w-100" data-bs-toggle="modal"
                            data-bs-target="#confirmationModal" disabled>Submit
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit this compost data?
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmSubmit" class="btn btn-success">Yes, Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1055;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
             aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('compostForm');
        const submitBtn = document.getElementById('submitBtn');
        const fields = {
            compostType: document.getElementById('CompostTypesProduced'),
            averageCompost: document.getElementById('averageCompost'),
            kitchenWasteCapacity: document.getElementById('kitchenWasteCapacity'),
            dateLogged: document.getElementById('dateLogged'),
        };
        const errors = {
            compostType: document.getElementById('compostTypeError'),
            averageCompost: document.getElementById('averageCompostError'),
            kitchenWasteCapacity: document.getElementById('kitchenWasteCapacityError'),
            dateLogged: document.getElementById('dateLoggedError'),
        };

        const validateForm = () => {
            let isValid = true;
            for (let field in fields) {
                if (fields[field].value === '') {
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

        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.getElementById('successToast');
            if (toastElement.querySelector('.toast-body').textContent.trim() !== '') {
                const toast = new bootstrap.Toast(toastElement);
                toast.show();
            }
        });
    </script>
</x-layout>
