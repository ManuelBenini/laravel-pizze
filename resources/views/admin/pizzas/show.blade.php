@extends('layouts.admin')

@section('title', "Pizza $pizza->nome")

@section('content')

        <h1>Pizza {{$pizza->nome}}</h1>

    <table class="table">

        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Prezzo</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Popolarità</th>
            <th scope="col">Vegetariana</th>
            <th scope="col">Azioni</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <th scope="row">{{$pizza->id}}</th>
                <td>{{$pizza->nome}}</td>
                <td>{{$pizza->prezzo}}&euro;</td>
                <td>{{$pizza->descrizione}}</td>

                @if ($pizza->popolarita === null)
                    <td>0</td>
                @else
                    <td>{{$pizza->popolarita}}</td>
                @endif

                @if ($pizza->vegetariana)
                    <td>Si</td>
                @else
                    <td>No</td>
                @endif

                <td>
                    <a href="{{route('admin.pizzas.edit', $pizza)}}" class="btn btn-secondary">Modifica</a>

                    <form
                    class="d-inline"
                    action="{{route('admin.pizzas.destroy', $pizza)}}"
                    method="POST"
                    onsubmit="return confirm('sei sicuro di voler eliminare la pizza?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancella</button>
                    </form>
                </td>

            </tr>
        </tbody>

        </table>

        <a href="{{route('admin.pizzas.index')}}">Torna alle pizze</a>

@endsection
