@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>Lista pizze</h1>

        <table class="table">

            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Prezzo</th>
                <th scope="col">Vegetariana</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($pizze as $pizza)
                    <tr>
                        <th scope="row">{{$pizza->id}}</th>
                        <td>{{$pizza->nome}}</td>
                        <td>{{$pizza->prezzo}}</td>

                        @if ($pizza->vegetariana)
                            <td>Si</td>
                        @else
                            <td>No</td>
                        @endif

                        <td>
                            <a href="{{route('admin.pizzas.show', $pizza)}}" class="btn btn-primary">Mostra</a>
                            <a href="{{route('admin.pizzas.edit', $pizza)}}" class="btn btn-secondary">Modifica</a>

                            <form class="d-inline" action="{{route('admin.pizzas.destroy', $pizza)}}">
                                <button type="submit" class="btn btn-danger">Cancella</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>

          </table>

          {{$pizze->links()}}
    </div>

@endsection
