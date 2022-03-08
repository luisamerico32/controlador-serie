@extends('layout')

@section('header')
    Séries
@endsection

@section('content')
    @include('message', compact('message'))

    @auth
    <a href="{{ route('create_series') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <img src="{{ $serie->background_url }}" alt="background" class="img-thumbnail" width="100px" height="100px">
                    <span id="name-serie-{{ $serie->id }}">{{ $serie->name }}</span>
                </div>

                <div class="input-group w-50" hidden id="input-name-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->name }}">
                    <div class="input-group-append">
                        @auth
                        <button class="btn btn-primary" onclick="editSeries({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                        @endauth
                    </div>
                </div>

                <span class="d-flex">
                    @auth
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    @endauth
                    <a href="/{{ $serie->id }}/seasons" class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    @auth
                    <form method="POST" action="/{{ $serie->id }}"
                        onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->name) }}?')" >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                    @endauth
                </span>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleInput(seriesId) {
            const nameSeries = document.querySelector(`#name-serie-${seriesId}`);
            const inputSeries = document.querySelector(`#input-name-serie-${seriesId}`);

            if (nameSeries.hasAttribute('hidden')) {
                nameSeries.removeAttribute('hidden');
                inputSeries.hidden = true;
            } else {
                inputSeries.removeAttribute('hidden');
                nameSeries.hidden = true;
            }
        }

        function editSeries(seriesId) {
            let formData = new FormData();
            const name = document.querySelector(`#input-name-serie-${seriesId} > input`).value;
            const token = document.querySelector('input[name="_token"]').value;
            formData.append('name', name);
            formData.append('_token', token);

            const url = `/${seriesId}/editName`;
            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(seriesId);
                document.querySelector(`#name-serie-${seriesId}`).textContent = name;
            });
        }
    </script>
@endsection
