@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Últimos Álbumes</h2>
        <div class="row">
            @foreach ($albums as $album)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/' . $album->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $album->title }}</h5>
                            <p class="card-text">{{ $album->description }}</p>
                            <form action="{{ route('albums.rate', $album->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="rating">Calificación (1-10):</label>
                                    <select name="rating" id="rating" class="form-control">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Calificar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
