@extends('layouts.admin')

@section('title', "Modifica pizza $pizza->name")

@section('content')

    <h1>Modifica pizza {{$pizza->name}}</h1>

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

    <form id="pizzaEditForm" action="{{route('admin.pizzas.update', $pizza)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nome --}}
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input
            type="text"
            class="form-control @error('nome') is-invalid @enderror"
            id="nome"
            name="nome"
            value="{{old('nome', $pizza->nome)}}"
            placeholder="Inserire nome">
        </div>

        @error('nome')
            <p class="text-danger">{{$message}}</p>
        @enderror

        <p id="error-nome" class="text-danger"></p>

        {{-- Descrizione --}}
        <div class="mb-3">
            <label for="descrizione" class="form-label">Ingredienti</label>
            <input
            type="text"
            class="form-control @error('descrizione') is-invalid @enderror"
            id="descrizione"
            name="descrizione"
            value="{{old('descrizione', $pizza->descrizione)}}"
            placeholder="Inserire descrizione">
        </div>

        @error('descrizione')
            <p class="text-danger">{{$message}}</p>
        @enderror

        <p id="error-descrizione" class="text-danger"></p>

        {{-- Immagine --}}
        <div class="image mb-3">
            <label for="immagine" class="form-label"><h4>Aggiungi immagine</h4></label>
            <input type="file" class="form-control immagine" id="immagine" name="immagine" accept="image/*">
        </div>

        @error('immagine')
            <p class="text-danger">{{$message}}</p>
        @enderror

        <p id="error-immagine" class="text-danger"></p>

        {{-- Prezzo --}}
        <div class="mb-3">
            <label for="prezzo" class="form-label">Prezzo</label>
            <input
            type="text"
            class="form-control @error('prezzo') is-invalid @enderror"
            id="prezzo"
            name="prezzo"
            value="{{old('prezzo', $pizza->prezzo)}}"
            placeholder="inserire prezzo">
        </div>

        @error('prezzo')
            <p class="text-danger">{{$message}}</p>
        @enderror

        <p id="error-prezzo" class="text-danger"></p>

        {{-- Popolarità --}}
        <div class="mb-3">
            <select name="popolarita" id="popolarita">

                <option value="" {{old('popolarita', $pizza->popolarita) == null ? 'selected' : ''}}>Non selezionato</option>

                @for ($c = 1; $c <= 10; $c++)
                    <option value="{{$c}}" {{old('popolarita', $pizza->popolarita) == $c ? 'selected' : ''}}>{{$c}}</option>
                @endfor

            </select>
        </div>

        {{-- Vegetariana --}}
        <div class="mb-3">
            <label for="vegetariana" class="form-label">Vegetariana</label>
            <select name="vegetariana" id="vegetariana">

                <option value="0" {{old('vegetariana', $pizza->vegetariana) == 0 ? 'selected' : ''}}>No</option>
                <option value="1" {{old('vegetariana', $pizza->vegetariana) == 1 ? 'selected' : ''}}>Si</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a onclick="return confirm('Sei sicuro di voler annullare tutte le modifiche?')" href="{{route('admin.pizzas.index')}}" class="btn btn-danger">Torna alla pagina principale</a>
    </form>



@endsection
