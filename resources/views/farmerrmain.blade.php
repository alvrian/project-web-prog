<x-layout>
  <x-navbar />
  @if(auth()->user()->role != "farmer")
    <div class="alert alert-warning" role="alert">
      You do not have the required permissions to access this section.
    </div>
  @else
    <div style="padding: 1rem 5rem; font-family: 'Inter', serif;">
      
      <x-farmer-component :pickup="$pickup" :delivery="$delivery" /><br>

      
      <div class="row">
        <div class="col-6">
          <a href="{{ route('crops.index') }}" style="text-decoration: none;">
            <button type="button" class="btn d-flex justify-content-between align-items-center"
                    style="color: white; height: 4rem; font-weight: 500; font-size: 18px; background-color: #43553D; width: 100%; border-radius: 12px;">
              View Your Crops Catalog
            </button>
          </a>
        </div>
        <div class="col-6">
          <a href="/farmer/create-crop" style="text-decoration: none;">
            <button type="button" class="btn d-flex justify-content-between align-items-center"
                    style="color: white; height: 4rem; font-weight: 500; font-size: 18px; background-color: #DFBE5C; width: 100%; border-radius: 12px;">
              Add New Crop
            </button>
          </a>
        </div>
      </div>

      
      <div class="dropend" style="display: flex; align-items: center; justify-content: space-between; font-size: 20px; font-weight: 600; padding-top: 2rem;">
        <span>Your Subscriptions</span>
        <a href="/farmer/composters" style="text-decoration: none;">
          <button type="button" class="btn btn-primary dropdown-toggle"
                  style="background-color: #43553D; border: none; font-size: 16px; padding: 0.5rem 1rem;">
            Add New
          </button>
        </a>
      </div>
      <div class="border rounded shadow-sm p-3 mt-3" style="height: 50vh; overflow-y: auto;">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          @if($data->isEmpty())
            <span>There isn't any subscription yet</span>
          @else
            @foreach ($data as $d)
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                          data-bs-target="#flush-collapse{{ $d->SubscriptionID }}">
                    <span>Subscription to {{ $d->providerName }}</span>
                    <span>Status: {{ $d->Status }}</span>
                  </button>
                </h2>
                <div id="flush-collapse{{ $d->SubscriptionID }}" class="accordion-collapse collapse">
                  <div class="accordion-body">
                    <div>Email: {{ $d->providerEmail }}</div>
                    <div>Duration: {{ $d->StartDate }} to {{ $d->EndDate }}</div>
                    <div>Service: {{ $d->ProductableType }}</div>
                    <div>Price: {{ $d->Price }}</div>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  @endif
</x-layout>
