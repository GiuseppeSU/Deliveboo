

    <h4>Hai ricevuto un nuovo ordine</h4>

    <div>L'ordine comprende:
        {{-- <ul>
            @foreach($order->cart as $item)
            <li>{{$item->product->name}}</li>
            @endforeach
        </ul> --}}
    </div>

    <p>Nome cliente: {{ $order->name}}</p>

    <p>Email: {{$order->email}}</p>

    <p>Indirizzo: {{$order->address}}</p>

    
    
