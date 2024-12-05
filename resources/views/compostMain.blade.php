
<x-layout>
  <x-navbar />
  @if(auth()->user()->role != "compost_producer")
    <div class="alert alert-warning" role="alert">
    You do not have the required permissions to access this section.
    </div>
  @else
  <div style="padding: 1rem 5rem;font-family:&quot;Inter&quot;, serif;">
    <x-compost-producer-component /><br>
    <span style = "font-size: 20px;font-weight: 600;">Your Subscriptions</span>
    <x-compost-view-subs />
  </div>
  @endif
</x-layout>
