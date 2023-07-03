<style>
    #my_container{
        background-color: rgb(248, 245, 242);
    }


    img{
        width: 50%;
        margin: auto;
    }

  
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    <div class="container text-center" id="my_container">
        <img class="img-fluid" src="{{asset('img/deliveboo.svg')}}" alt="Logo deliveboo">
        <h1 class=" w-50 m-auto mb-5">{{ $order->name}} il tuo ordine da {{ $restaurant_name[0]->name }} è stato confermato </h1>
    
     <div class="container ">
        
            <h3 class="mb-4">Il tuo ordine comprende:</h3>
            <table class="table w-50 m-auto">
                    <tbody>
                        @foreach($order->products as $product)
                      <tr>
                        <th scope="row">{{$product->pivot->quantity}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price * $product->pivot->quantity}}</td>
                        
                     </tr>
                      @endforeach
                      
                      <tr>
                        <td colspan="2">Totale</td>
                        <td>{{$total}}</td>
                      </tr>
                    </tbody>
                  </table>
            </table>
    </div>
    <div class="mt-4">
        <p>{{ $order->name}} grazie per averci scelto!</p>
        <p>Per problemi relativi all'ordine non esiti a contattare l'assitenza</p>
        <p>Email: <a href="#">assistenzaDeliveboo.com</a></p>

    </div>

  
    
</body>
</html>





