<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="text-container mt-5 text-center">
        <img class="img-fluid" src="{{asset('img/deliveboo.svg')}}" alt="Logo deliveboo">
        <h1>Hai ricevuto un nuovo ordine</h1>
        <div>
            <h2>L'ordine comprende:</h2>
            @foreach($order->products as $product)
            <h4>{{$product->name}} {{$product->pivot->quantity}}</h4>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            <table class="table table-bordered  w-75">
                <thead>
                  <tr class="info-container">
                    <th scope="col">Nome cliente:</th>
                    <th scope="col">Email:</th>
                    <th scope="col">Indirizzo:</th>
                    <th scope="col">Num Telefono:</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td> {{ $order->phone_number }}</td>
                </tr>
            </tbody>
              </table>
        </div>
    </div>
</body>
</html>

<style>
    
    .text-container{
        background-color: rgb(248, 245, 242);
        

    }
    .info-container{
        margin-bottom: 60px;
        border: 2px solid black;

    }

    img{
        width: 50%;
        margin: auto;
    }


    

 


</style>





    
    
