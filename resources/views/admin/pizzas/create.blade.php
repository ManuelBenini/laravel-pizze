@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>Sono il create della CRUD</h1>

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

        <form action="{{route('admin.pizzas.store')}}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input
              type="text"
              class="form-control"
              id="nome"
              name="nome"
              value="{{old('nome')}}"
              placeholder="Inserire nome">
            </div>

            @error('nome')
                <p class="text-danger">{{$message}}</p>
            @enderror

            <div class="mb-3">
              <label for="descrizione" class="form-label">Ingredienti</label>
              <input
              type="text"
              class="form-control"
              id="descrizione"
              name="descrizione"
              value="{{old('descrizione')}}"
              placeholder="Inserire descrizione">
            </div>

            @error('descrizione')
                <p class="text-danger">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="prezzo" class="form-label">Prezzo</label>
                <input
                type="text"
                class="form-control"
                id="prezzo"
                name="prezzo"
                value="{{old('prezzo')}}"
                placeholder="inserire prezzo">
            </div>

            @error('prezzo')
                <p class="text-danger">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="vegetariana" class="form-label">Vegetariana</label>
                <select name="vegetariana" id="vegetariana">

                    <option value="0" {{old('vegetariana') == 0 ? 'selected' : ''}}>No</option>
                    <option value="1" {{old('vegetariana') == 1 ? 'selected' : ''}}>Si</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>


@endsection
