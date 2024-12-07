<x-layout>
  <x-navbar />
  @if(auth()->user()->role != "restaurant_owner")
    <div class="alert alert-warning" role="alert">
    You do not have the required permissions to access this section.
    </div>
  @else
    <div style="padding: 1rem 5rem;font-family:&quot;Inter&quot;, serif;">
    <x-restaurant-pick-up-schedule /><br>
    <h5>Lanjut isi sini apus nanti</h5>
    </div>
  @endif
</x-layout>