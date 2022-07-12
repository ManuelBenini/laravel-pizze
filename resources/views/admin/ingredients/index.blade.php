@extends('layouts.admin')

@section('title', "Lista ingredienti")

@section('content')

    <h1 class="my-3 mb-5">Lista ingredienti e pizze</h1>

    @if(session('ingredient_delete_success'))
        <div class="alert alert-danger d-flex justify-content-between" role="danger">
            <p>{{session('ingredient_delete_success')}}</p>
            <a href="{{route('admin.ingredients.index')}}" class="btn btn-danger">X</a>
        </div>
    @endif

    <div>

        @foreach ($ingredients as $ingredient)
            <h3>
                {{$ingredient->nome}}
                <a href="{{route('admin.ingredients.edit', $ingredient)}}" class="btn btn-success">Modifica</a>

                <form
                    class="d-inline"
                    action="{{route('admin.ingredients.destroy', $ingredient)}}"
                    method="POST"
                    onsubmit="return confirm('sei sicuro di voler eliminare l\'ingrediente?')" >

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </form>
            </h3>


            <ul>

                @forelse ($ingredient->pizzas as $pizza)
                    <li> <a href="{{route('admin.pizzas.show', $pizza)}}">Pizza {{$pizza->nome}} </a> </li>
                @empty
                    <li> Non sono presenti pizze con questo ingrediente </li>
                @endforelse

            </ul>

        @endforeach

    </div>


@endsection

