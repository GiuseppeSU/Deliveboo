

    <h4>Hai ricevuto un nuovo ordine</h4>

    <div>L'ordine comprende:
        <ul>
            @foreach($order->products as $product)
            <li>{{$product->name}} {{$product->pivot->quantity}}</li>
            @endforeach
        </ul>
    </div>

    <p>Nome cliente: {{ $order->name}}</p>

    <p>Email: {{$order->email}}</p>

    <p>Indirizzo: {{$order->address}}</p>

    <p>Num Telefono: {{ $order->phone_number }}</p>

    
    
