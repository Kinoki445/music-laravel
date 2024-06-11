@extends('layouts.app')
@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row mt-4 mb-4">
        <h2>All Tracks</h2>
        <div class="col-md-6">
            <a href="{{ route('music.create') }}" class="btn btn-success">Add Track</a>
            <a href="{{ route('playlist.create') }}" class="btn btn-primary">Create Playlist</a>
            <a href="{{ route('playlist.index') }}" class="btn btn-info">View All Playlists</a>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Search tracks" aria-label="Search tracks" aria-describedby="search-button">
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
                    <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'year_asc']) }}">Ascending</a>
                    <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'year_desc']) }}">Descending</a>
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
                    @auth
                    <form action="{{ route('music.like', $track->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; padding: 0; color: #337ab7; text-decoration: underline; cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                            </svg>
                        </button>
                    </form>
                    {{ $track->likes()->count() }}
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                    </svg> {{ $track->likes()->count() }}
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection
