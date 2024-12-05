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
    <div class="accordion accordion-flush" id="accordionFlushExample"
      style="width: 100%;box-shadow: 4px 7px 8px 0px rgba(163,163,163,0.1);height: 100%;padding:1rem;border: 2px solid #b8b8b8;border-radius: 12px;margin: 1rem 0 1rem 0;">
        @for ($i = 0; $i< 5;$i++)
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$i}}" aria-expanded="false" aria-controls="flush-collapse{{$i}}">
              Accordion Item #{{$i}}
            </button>
          </h2>
          <div id="flush-collapse{{$i}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              Placeholder content for this accordion, which is intended to demonstrate the<code>.accordion-flush</code> class. 
              This is the first item's accordion body.
            </div>
          </div>
        </div>
        @endfor
    </div>
  @endif
</x-layout>