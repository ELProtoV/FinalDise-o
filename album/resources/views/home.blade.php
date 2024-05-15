@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('albums.create') }}" class="btn btn-primary">Crear Álbum</a>

        <h2>Últimos Álbumes</h2>
        <div class="row">
            @foreach ($albums as $album)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('images/' . $album->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $album->title }}</h5>
                            <p class="card-text">{{ $album->description }}</p>
                            <a href="{{ route('albums.show', $album->id) }}" class="btn btn-primary">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
