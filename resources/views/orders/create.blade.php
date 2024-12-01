<x-layout>
    <h1>Place Order for {{ $crop->name }}</h1>
    <form action="{{ route('orders.store', $crop->id) }}" method="POST">
        @csrf
        <input type="number" name="quantity" class="form-control" min="1" required>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</x-layout>
