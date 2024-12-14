<x-layout>
  <x-navbar />
  @if(auth()->user()->role != "compost_producer")
    <div class="alert alert-warning" role="alert">
      You do not have the required permissions to access this section.
    </div>
  @else
    <div style="padding: 1rem 5rem;font-family:&quot;Inter&quot;, serif;">

      <x-compost-producer-component /><br>
      <a href = "{{route('compost.index')}}">
        <span style = "display: block;">
        to composts>
        </span>
      </a>
      <a href = "/compost-producer/resto-owners">
        <span style = "display: block;">
        to resto_owners>
        </span>
      </a>
      <span style="font-size: 20px;font-weight: 600;">Your Subscriptions</span>
      <div style="padding: 10px;border: 2px solid #b8b8b8;box-shadow: 4px 7px 8px 0px rgba(163,163,163,0.1);border-radius: 12px;margin: 1rem 0 1rem 0;">
        <div class="accordion accordion-flush" id="accordionFlushExample" style="width: 100%; height: 50vh; overflow-y: auto; overflow-x:hidden">
          @if($data->isEmpty())
            <span>there isn't any subscription yet</span>
          @else
            @foreach ($data as $d)
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$d->SubscriptionID}}" aria-expanded="false" aria-controls="flush-collapse{{$d->SubscriptionID}}">
                    <div class="row text-left" style="width: 70%;">
                      <span class="col">Subscription to {{$d->providerName}}</span>
                      <span class="col">Status: {{$d->Status}}</span>
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
                        <div>: {{ $d->ProductableType }}</div>
                        <div>: {{ $d->Price }}</div>
                      </div>
                      <div class="col-5 row" style="border-left: 1px solid grey">
                        <div><strong>Action</strong></div>
                        @if($d->Status == 'Active')
                          <form method="POST" action="{{ route('compost.subsManagePause') }}" class="pauseForm col-2" data-subscription-id="{{ $d->SubscriptionID }}">
                            @csrf
                            <input type="hidden" name="subscriptionID" value="{{ $d->SubscriptionID }}">
                            <button class="btn mt-2" type="submit" style="background-color: #DFBE5C; color:white;" @if($d->Status == 'Postponed') disabled @endif>
                                Pause
                            </button>
                          </form>
                        @elseif($d->Status == 'Postponed')
                          <form method="POST" action="{{ route('compost.subsManageResume') }}" class="resumeForm" data-subscription-id="{{ $d->SubscriptionID }}">
                            @csrf
                            <input type="hidden" name="subscriptionID" value="{{ $d->SubscriptionID }}">
                            <button class="btn mt-2" style="background-color:#43553D; color:white;" type="submit" @if($d->Status == 'Active') disabled @endif>
                                Resume
                            </button>
                          </form>
                        @endif
                        <form method="POST" action="{{ route('compost.subsManageCancel') }}" class="cancelForm mt-2" data-subscription-id="{{ $d->SubscriptionID }}">
                          @csrf
                          <input type="hidden" name="subscriptionID" value="{{ $d->SubscriptionID }}">
                          <button type="button" class="btn btn-danger" onclick="confirmCancellation(event, '{{ $d->SubscriptionID }}')">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>

    </div>
  @endif

<script>
document.querySelectorAll('.pauseForm').forEach(function(form) {
    form.addEventListener('submit', function() {
        let subscriptionId = form.getAttribute('data-subscription-id');
        document.querySelector(`.resumeForm[data-subscription-id="${subscriptionId}"] button`).disabled = true;
    });
});

document.querySelectorAll('.resumeForm').forEach(function(form) {
    form.addEventListener('submit', function() {
        let subscriptionId = form.getAttribute('data-subscription-id');
        document.querySelector(`.pauseForm[data-subscription-id="${subscriptionId}"] button`).disabled = true;
    });
});

function confirmCancellation(event, subscriptionId) {
        event.preventDefault();
        if (confirm("Are you sure you want to cancel this subscription?")) {
            let form = document.querySelector('.cancelForm[data-subscription-id="' + subscriptionId + '"]');
            form.submit();
        }
    }
</script>

</x-layout>
