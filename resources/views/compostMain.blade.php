<x-layout>
  <x-navbar />
  @if(auth()->user()->role != "compost_producer")
    <div class="alert alert-warning" role="alert">
    You do not have the required permissions to access this section.
    </div>
  @else
    <div style="padding: 1rem 5rem;font-family:&quot;Inter&quot;, serif;">
    <x-compost-producer-component /><br>
    <span style="font-size: 20px;font-weight: 600;">Your Subscriptions</span>
    <div style ="padding: 10px;border: 2px solid #b8b8b8;box-shadow: 4px 7px 8px 0px rgba(163,163,163,0.1);border-radius: 12px;margin: 1rem 0 1rem 0;">
      <div class="accordion accordion-flush" id="accordionFlushExample"
        style="width: 100%;height: 100%;height: 50vh;overflow-y: auto;overflow-x:hidden">
          @foreach ($data as $d)
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$d->SubscriptionID}}" aria-expanded="false" aria-controls="flush-collapse{{$d->SubscriptionID}}">
                <div class = "row text-left" style="width: 70%;">
                  <span class = "col">Subscription to {{$d->providerName}}</span>
                  <span class = "col">Status: {{$d->Status}}</span>
                </div>
              </button>
            </h2>
            <div id="flush-collapse{{$d->SubscriptionID}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body d-grid gap-3">
              <div class="row">
                <div class="col-1">
                  <div><strong>Email</strong></div>
                  <div><strong>Duration</strong></div>
                  <div><strong>Service</strong></div>
                  <div><strong>Price</strong></div>
                </div>
                <div class="col-4 text-muted">
                  <div>: {{ $d->providerEmail }}</div>
                  <div>: {{ $d->StartDate }} to {{ $d->EndDate }}</div>
                  <div>: {{ $d->Products[0] }}</div>
                  <div>: {{ $d->Price }}</div>
                </div>
                <div class = "col-5" style = "border-left: 1px solid grey">
                  <div><strong>Action</strong></div>
                  <form method = "POST" action = "{{route('compost.subsManagePause')}}">
                    @csrf
                    <input type="hidden" name="subscriptionID" value={{$d->SubscriptionID}}>
                    <button class="btn mt-2" type="submit" style = "background-color: #DFBE5C;color:white;" 
                      @if($d->Status == 'Postponed') disabled @endif>
                      Pause
                    </button>
                  </form>
                  <form method = "POST" action = "{{route('compost.subsManageResume')}}">
                  @csrf
                    <input type="hidden" name="subscriptionID" value={{$d->SubscriptionID}}>
                    <button class="btn mt-2" style = "background-color:#43553D;color:white;" type="submit" 
                      @if($d->Status == 'Active') disabled @endif>
                      Resume
                    </button>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
          @endforeach
      </div>
    </div>
  @endif
  <style>
    #accordionFlushExample::-webkit-scrollbar {
      margin: 1rem;
      width: 7px;
    }
    #accordionFlushExample::-webkit-scrollbar-thumb {
      background-color: #888;
      border-radius: 10px;
    }
    #accordionFlushExample::-webkit-scrollbar-thumb:hover {
      background-color: #555;
    }
    #accordionFlushExample::-webkit-scrollbar-track {
      border-radius: 10px;
    }
    .accordion-button {
    border-color: transparent !important; /* Removes border color */
    box-shadow: none !important; /* Ensures no blue shadow appears */
    }
    .accordion-button:focus {
        border-color: transparent !important;
        outline: none !important; /* Removes focus outline */
        box-shadow: none !important;
    }
    .accordion-button:not(.collapsed) {
      background-color: white;
    }
  </style>
</x-layout>