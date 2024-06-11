@extends('layouts.app')
@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <h2>All Tracks</h2>
        <div class="col-md-6">
            <a href="{{ route('music.create') }}" class="btn btn-success">Add Track</a>
            <a href="{{ route('music.create') }}" class="btn btn-primary">Create Playlist</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Search tracks" aria-label="Search tracks" aria-describedby="search-button">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                </div>
            </div>
        </div>
    </div>
    <div id="searchResults" class="row">
        <div class="col-md-12">
            <div class="btn-group mb-3">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by Year
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Ascending</a>
                    <a class="dropdown-item" href="#">Descending</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($tracks as $track)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-img-top" style="background-image: url('{{ asset('/storage/'. $track->cover) }}'); background-size: cover; background-position: center; height: 300px;"></div>
                <div class="card-body">
                    <h5 class="card-title">{{ $track->title }}</h5>
                    <p class="card-text">{{ $track->artist }}</p>
                    <a href="{{ route('user.profile', ['id' => $track->user_id]) }}">Профиль пользователя</a>
                    <audio controls>
                        <source src="{{ asset('/storage/'. $track->file) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <form action="{{ route('music.like', ['musicId' => $track->id]) }}" method="POST">
                        @csrf
                        <button type="submit">Like</button>
                    </form>

                    <form action="{{ route('music.unlike', ['musicId' => $track->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Unlike</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

@endsection
