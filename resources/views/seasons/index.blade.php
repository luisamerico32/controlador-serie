@extends('layout')

@section('header')
    Temporadas de {{ $series->name }}
@endsection

@section('content')

    @if($series->background)
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <a href="{{ $series->background_url }}" target="_blank">
                <img src="{{ $series->background_url }}" alt="background" class="img-thumbnail" width="400px" height="400px">
            </a>
        </div>
    </div>
    @endif

    <ul class="list-group mb-4">
        @foreach($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="/seasons/{{ $season->id }}/episodes">
                    Temporada {{ $season->number }}
                </a>
                <span class="badge badge-secondary">
                    {{ $season->getEpisodesWatched()->count() }} / {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>

@endsection
