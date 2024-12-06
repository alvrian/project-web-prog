
<x-layout>
    <x-navbar/>
    @if(auth()->user()->role != "farmer")
    <div class="alert alert-warning" role="alert">
        You do not have the required permissions to access this section.
    </div>
    @else
    <div style="padding: 1rem 5rem;font-family:&quot;Inter&quot;, serif;">
        hello, ini page main farmer
        <x-farmer-subscription />
    </div>
    @endif
</x-layout>
