<h4>{{ $order->name}} il tuo ordine {{ $restaurant_name[0]->name }} da è stato confermato </h4>

<div>Il tuo ordine comprende:
    <ul>
        @foreach($order->products as $product)
        <li>{{$product->name}} {{$product->pivot->quantity}}</li>
        @endforeach
    </ul>
</div>

<p>Nome cliente: {{ $order->name}}</p>
