@extends('layouts.admin')

@section('title', "Pizza $pizza->nome")

@section('content')

    <h1 class="text-center mb-3">Pizza {{$pizza->nome}}</h1>

    <div class="d-flex justify-content-center align-items-center">
        <div class="card text-center mb-4" style="width: 18rem;">

            {{-- Se esiste un immagine, si inserisce, altrimenti viene usata l'immagine di placeholder --}}
            @if ($pizza->immagine)
                <img src="{{asset('image/'.$pizza->immagine)}}" class="card-img-top" alt="Immagine pizza">
            @else
                <img src="{{asset('image/scatola_pizza.png')}}" class="card-img-top" alt="Immagine placeholder">
            @endif


            <div class="card-body">
                <h5 class="card-title">{{$pizza->nome}}</h5>
                <p class="card-text">{{$pizza->descrizione}}</p>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">prezzo: {{$pizza->prezzo}}&euro;</li>
                <li class="list-group-item">Popolarità: {{$pizza->popolarita}}</li>

                @if ($pizza->vegetariana)
                    <li class="list-group-item">Vegetariana: <img src="{{asset('image/13b01a3ed103ff17233aa8dcca6d5313-vegetarian-round-green-badge.png')}}" style="width: 35px; height: 35px" alt="logo vegetariano"></li>
                @else
                    <li class="list-group-item">Vegetariana: no</li>
                @endif

                <li class="list-group-item">
                    <a href="{{route('admin.pizzas.edit', $pizza)}}" class="btn btn-success">Modifica</a>

                    <form
                    class="d-inline"
                    action="{{route('admin.pizzas.destroy', $pizza)}}"
                    method="POST"
                    onsubmit="return confirm('sei sicuro di voler eliminare la pizza?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancella</button>
                    </form>

                </li>

            </ul>

        </div>

    </div>
    <a class="text-center d-block btn btn-primary m-auto" style="width: 250px" href="{{route('admin.pizzas.index')}}">Torna alle pizze</a>

@endsection
