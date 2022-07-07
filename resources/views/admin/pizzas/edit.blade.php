@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>Sono l'edit della CRUD</h1>

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

        <form id="pizzaEditForm" action="{{route('admin.pizzas.update', $pizza)}}" method="POST">
            @csrf
            @method('PUT')

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

            <div class="mb-3">
                <select name="popolarita" id="popolarita">

                    <option value="" {{old('popolarita', $pizza->popolarita) == null ? 'selected' : ''}}>Non selezionato</option>

                    @for ($c = 1; $c <= 10; $c++)
                        <option value="{{$c}}" {{old('popolarita', $pizza->popolarita) == $c ? 'selected' : ''}}>{{$c}}</option>
                    @endfor

                </select>
            </div>

            @error('popolarita')
                <p class="text-danger">{{$message}}</p>
            @enderror

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

    </div>


@endsection
