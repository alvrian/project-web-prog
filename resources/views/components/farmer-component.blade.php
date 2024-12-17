<div style="width: 100%; min-height: 100%;">
  <!-- Navigation -->
  <nav id="horizontal-list-example" class="nav nav-pills justify-content-start">
    <a class="nav-link" style="color: black;" data-scroll-to="#horizontal-list-item-1" href="javascript:void(0)">Crops Delivery</a>
    <a class="nav-link" style="color: black;" data-scroll-to="#horizontal-list-item-2" href="javascript:void(0)">Compost Drop Off</a>
  </nav>

  <!-- Horizontal Scroll Container -->
  <div id="horizontal-scroll-container" style="display: flex; overflow-x: auto; scroll-snap-type: x mandatory; padding: 0.5rem;">
    
    <!-- Section 1: Crops Delivery -->
    <div id="horizontal-list-item-1" style="flex: 0 0 100%; scroll-snap-align: start; padding: 0.5rem;">
      <div class="row" style="height: 65vh;">
        <!-- Crops Delivery Schedule -->
        <div class="col-12 col-md-7" style="padding: 0 4px;">
          <div class="border rounded shadow-sm p-3" style="height: 100%;">
            <div class="d-flex justify-content-between">
              <span style="font-size: 20px; font-weight: 600;">Crops Delivery Schedule</span>
              <span>All Time</span>
            </div>
            <ul class="list-group mt-3" style="height: 85%; overflow-y: auto;">
              @if($pickup->isEmpty())
                <li class="list-group-item text-center text-muted" style="font-style: italic;">
                  You have no crops delivery schedules for this month
                </li>
              @else
                @foreach ($pickup as $d)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>&bull; {{ $d->FormattedScheduledDate }}</span>
                    <span>to <strong>{{ $d->RecipientName }}</strong> at <em>{{ $d->location }}</em></span>
                  </li>
                @endforeach
              @endif
            </ul>
          </div>
        </div>

        <!-- Add Schedule Form for Crops Delivery -->
        <div class="col-12 col-md-5" style="padding: 0 4px;">
          <div class="border rounded shadow-sm p-3" style="height: 100%; overflow-y: auto;">
            <span style="font-size: 20px; font-weight: 600;">Add Crops Delivery</span>
            <form method="POST" action="{{ route('addSchedule') }}" class="d-flex flex-column gap-3">
              @csrf
              <div class="mb-3">
                <label for="recipientType" class="form-label">Role</label>
                <select class="form-select" name="RecipientType" required>
                  <option value="" disabled selected>Select an option</option>
                  <option value="restaurant_owner">Restaurant</option>
                  <option value="compost_producer">Compost Producer</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" required>
              </div>
              <button type="submit" class="btn text-white" style="background-color: #43553D;">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Section 2: Compost Drop Off -->
    <div id="horizontal-list-item-2" style="flex: 0 0 100%; scroll-snap-align: start; padding: 0.5rem;">
      <div class="row" style="height: 65vh;">
        <!-- Compost Drop Off Schedule -->
        <div class="col-12 col-md-7" style="padding: 0 4px;">
          <div class="border rounded shadow-sm p-3" style="height: 100%;">
            <div class="d-flex justify-content-between">
              <span style="font-size: 20px; font-weight: 600;">Compost Drop Off Schedule</span>
              <span>All Time</span>
            </div>
            <ul class="list-group mt-3" style="height: 85%; overflow-y: auto;">
              @if($delivery->isEmpty())
                <li class="list-group-item text-center text-muted" style="font-style: italic;">
                  You have no compost drop off schedules for this month
                </li>
              @else
                @foreach ($delivery as $d)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>&bull; {{ $d->FormattedScheduledDate }}</span>
                    <span>to <strong>{{ $d->RecipientName }}</strong> at <em>{{ $d->location }}</em></span>
                  </li>
                @endforeach
              @endif
            </ul>
          </div>
        </div>

        <!-- Add Schedule Form for Compost Drop Off -->
        <div class="col-12 col-md-5" style="padding: 0 4px;">
          <div class="border rounded shadow-sm p-3" style="height: 100%; overflow-y: auto;">
            <span style="font-size: 20px; font-weight: 600;">Add Compost Drop Off</span>
            <form method="POST" action="{{ route('addSchedule') }}" class="d-flex flex-column gap-3">
              @csrf
              <div class="mb-3">
                <label for="recipientType" class="form-label">Role</label>
                <select class="form-select" name="RecipientType" required>
                  <option value="" disabled selected>Select an option</option>
                  <option value="farmer">Farmer</option>
                  <option value="restaurant_owner">Restaurant</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" required>
              </div>
              <button type="submit" class="btn text-white" style="background-color: #43553D;">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Alert for Success/Failed -->
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @elseif(session('failed'))
    <div class="alert alert-danger">{{ session('failed') }}</div>
  @endif
</div>

<!-- JavaScript for Smooth Navigation -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('#horizontal-list-example .nav-link');
    const container = document.getElementById('horizontal-scroll-container');

    navLinks[0].style.fontWeight = 'bold';

    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        navLinks.forEach(nav => nav.style.fontWeight = 'normal');
        link.style.fontWeight = 'bold';

        const target = document.querySelector(link.getAttribute('data-scroll-to'));
        container.scrollTo({
          left: target.offsetLeft,
          behavior: 'smooth'
        });
      });
    });
  });
</script>
