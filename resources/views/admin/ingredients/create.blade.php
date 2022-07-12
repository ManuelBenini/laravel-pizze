@extends('layouts.admin')

@section('title', "Inserisci ingrediente")

@section('content')

    <h1>Inserisci nuovo ingrediente</h1>

    @if ($errors->any())

        <div class="alert alert-danger" role="alert">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>

        </div>
    @endif

    @if(session('ingredient_exist'))
        <div class="alert alert-danger d-flex justify-content-between" role="danger">
            <p>{{session('ingredient_exist')}}</p>
            <a href="{{route('admin.ingredients.create')}}" class="btn btn-danger">X</a>
        </div>
    @endif

    <form id="ingredientCreateForm" action="{{route('admin.ingredients.store')}}" method="POST">
        @csrf

        {{-- Nome --}}
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input
            type="text"
            class="form-control @error('nome') is-invalid @enderror"
            id="nome"
            name="nome"
            value="{{old('nome', session('ingredient'))}}"
            placeholder="Inserire nome">
        </div>

        @error('nome')
            <p class="text-danger">{{$message}}</p>
        @enderror

        <p id="error-nome" class="text-danger"></p>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



@endsection
