@extends('layouts.admin')

@section('title', "Lista pizze")

@section('content')

    <h1>Lista pizze</h1>

    @if(session('pizza_delete_success'))
        <div class="alert alert-danger d-flex justify-content-between" role="danger">
            <p>{{session('delete_success')}}</p>
            <a href="{{route('admin.pizzas.index')}}" class="btn btn-danger">X</a>
        </div>
    @endif

    <table class="table text-center">

        <thead>
            <tr>
            <th scope="col"><a href="{{route('admin.pizzas.index')}}">ID</a></th>
            <th scope="col">
                <a href="{{route('admin.pizzas.index')}}?query=nome">Nome</a>
            </th>

            <th scope="col">
                <a href="{{route('admin.pizzas.index')}}?query=prezzo">Prezzo</a>
            </th>

            <th scope="col">
                <a href="{{route('admin.pizzas.index')}}?query=popolarita">Popolarità</a>
            </th>

            <th scope="col">
                <a href="{{route('admin.pizzas.index')}}?query=vegetariana">Vegetariana</a>
            </th>

            <th scope="col">Azioni <i class="fa-solid fa-arrow-down"></i></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pizze as $pizza)
                <tr>
                    <th scope="row">{{$pizza->id}}</th>
                    <td>{{$pizza->nome}}</td>
                    <td>{{$pizza->prezzo}}&euro;</td>

                    @if ($pizza->popolarita === null)
                        <td>0</td>
                    @else
                        <td>{{$pizza->popolarita}}</td>
                    @endif

                    @if ($pizza->vegetariana)
                        <td><img src="{{asset('image/13b01a3ed103ff17233aa8dcca6d5313-vegetarian-round-green-badge.png')}}" style="width: 35px; height: 35px" alt="logo vegetariano"></td>
                    @else
                        <td>No</td>
                    @endif

                    <td>
                        <a href="{{route('admin.pizzas.show', $pizza)}}" class="btn btn-primary">Mostra</a>
                        <a href="{{route('admin.pizzas.edit', $pizza)}}" class="btn btn-success">Modifica</a>

                        <form
                        class="d-inline"
                        action="{{route('admin.pizzas.destroy', $pizza)}}"
                        method="POST"
                        onsubmit="return confirm('sei sicuro di voler eliminare la pizza?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>

        </table>

        {{$pizze->links()}}

@endsection
