@extends('layout')

@section('header')
    Adicionar Séries
@endsection

@section('content')
    @include('errors', ['errors' => $errors])

    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="col col-2">
                <label for="seasons">Nº Temporadas</label>
                <input type="number" class="form-control" name="seasons">
            </div>

            <div class="col col-2">
                <label for="episodes">Nº Episódios</label>
                <input type="number" class="form-control" name="episodes">
            </div>
        </div>
        <div class="row">
            <div class="col col-12">
                <label for="background">Capa</label>
                <input type="file" class="form-control" name="background">
            </div>
        </div>
        <button class="btn btn-primary mt-2">Adicionar</button>
    </form>
@endsection
