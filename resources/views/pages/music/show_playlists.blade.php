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

    <div class="row">
        @foreach($playlists as $playlist)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                        {{ $playlist->title }}
                    </button>
                </h2>
                <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                            @foreach($playlist->music as $track) <!-- Используйте отношение для доступа к трекам -->
                                <li>
                                    <a href="{{ route('user.profile', ['id' => $track->user_id]) }}">
                                        <strong>{{ $track->title }}</strong> - {{ $track->artist }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

