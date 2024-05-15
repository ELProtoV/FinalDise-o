@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles del Álbum</h2>
        <div class="card mb-3">
            <img src="{{ asset('images/' . $album->image) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $album->title }}</h5>
                <p class="card-text">{{ $album->description }}</p>
                <p class="card-text"><small class="text-muted">Creado por: {{ $album->user->name }}</small></p>
                <p class="card-text">Calificación: {{ $album->rating }}</p>
            </div>
        </div>
        <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary">Editar</a>
        <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este álbum?')">Eliminar</button>
        </form>
    </div>
@endsection
