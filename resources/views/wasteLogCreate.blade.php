<x-layout>
    <x-navbar/>
    <div class="container d-flex justify-content-center align-items-center"
         style="min-height: 100vh; background-color: #e9f0e4;">
        <div class="col-md-6">
            <form id="wasteForm" method="POST" action="{{ route('waste_log.store') }}" class="p-4 rounded shadow"
                  style="background-color: #f9f9f9;">
                @csrf
                <a href="{{ route('waste_log.list', ['restaurantOwnerID' => auth()->id()]) }}" class="btn btn-light">
                    <span>Back</span>
                </a>

                <h3 class="text-center mb-4" style="color: #4b5320;">Log Waste Entry</h3>

                <div class="mb-3">
                    <label for="wasteType" class="form-label">Waste Type</label>
                    <select class="form-select" id="wasteType" name="WasteType" required>
                        <option value="" disabled selected>Select Waste Type</option>
                        <option value="Fruit Waste">Fruit Waste</option>
                        <option value="Vegetable Waste">Vegetable Waste</option>
                        <option value="Coffee Grounds">Coffee Grounds</option>
                        <option value="Tea Leaves">Tea Leaves</option>
                        <option value="Eggshells">Eggshells</option>
                        <option value="Food Scraps">Food Scraps</option>
                        <option value="Other">Other</option>
                    </select>
                    <small class="text-danger d-none" id="wasteTypeError">Please select a waste type.</small>
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Weight (kg)</label>
                    <input type="number" class="form-control" id="weight" name="Weight" placeholder="Enter Weight"
                           required>
                    <small class="text-danger d-none" id="weightError">Please enter the weight.</small>
                </div>

                <div class="mb-3">
                    <label for="dateLogged" class="form-label">Date Logged</label>
                    <input type="date" class="form-control" id="dateLogged" name="DateLogged"
                           value="{{ now()->format('Y-m-d') }}" required>
                    <small class="text-danger d-none" id="dateLoggedError">Please enter a date.</small>
                </div>

                <div class="text-center">
                    <button type="button" id="submitBtn" class="btn btn-success w-50" data-bs-toggle="modal"
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
                    Are you sure you want to submit this data?
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
        const form = document.getElementById('wasteForm');
        const submitBtn = document.getElementById('submitBtn');
        const fields = {
            wasteType: document.getElementById('wasteType'),
            weight: document.getElementById('weight'),
            dateLogged: document.getElementById('dateLogged')
        };
        const errors = {
            wasteType: document.getElementById('wasteTypeError'),
            weight: document.getElementById('weightError'),
            dateLogged: document.getElementById('dateLoggedError')
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
            const form = document.getElementById('wasteForm');
            const wasteType = document.getElementById('wasteType').value;
            const weight = document.getElementById('weight').value;
            const dateLogged = document.getElementById('dateLogged').value;

            if (!wasteType || !weight || !dateLogged) {
                alert("Please fill in all required fields.");
                return;
            }
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

    </script>
</x-layout>
