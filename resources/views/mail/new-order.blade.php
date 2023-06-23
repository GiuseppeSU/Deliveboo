

    <h4>Hai ricevuto un nuovo ordine</h4>

    <div>L'ordine comprende:
        <ul v-for="product as $lead->products">
            <li>{{$lead->products}}</li>
        </ul>
    </div>

    <p>Nome cliente: {{ $lead->name}}</p>

    <p>Email: {{$lead->email}}</p>

    <p>Indirizzo: {{$lead->address}}</p>

    
    
