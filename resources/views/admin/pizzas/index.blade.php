@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>Lista pizze</h1>

        @if(session('delete_success'))
            <div class="alert alert-danger d-flex justify-content-between" role="danger">
                <p>{{session('delete_success')}}</p>
                <a href="{{route('admin.pizzas.index')}}" class="btn btn-danger">X</a>
            </div>
        @endif

        <table class="table">

            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Prezzo</th>
                <th scope="col">Popolarità</th>
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
                            <a href="{{route('admin.pizzas.show', $pizza)}}" class="btn btn-primary">Mostra</a>
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
                @endforeach
            </tbody>

          </table>

          {{$pizze->links()}}
    </div>

@endsection
