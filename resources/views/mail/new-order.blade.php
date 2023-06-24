

    <h4>Hai ricevuto un nuovo ordine</h4>

    <div>L'ordine comprende:
        <ul>
            @foreach($lead->pruducts as $product)
            <li>{{$product}}</li>
            @endforeach
        </ul>
    </div>

    <p>Nome cliente: {{ $lead->name}}</p>

    <p>Email: {{$lead->email}}</p>

    <p>Indirizzo: {{$lead->address}}</p>

    
    
