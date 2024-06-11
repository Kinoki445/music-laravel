@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Playlist') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('playlist.create') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control mb-3" name="playlist[title]" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tracks" class="col-md-4 col-form-label text-md-right">{{ __('Tracks') }}</label>

                                <div class="col-md-6">
                                    @foreach($tracks as $track)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="playlist[tracks][]" value="{{ $track->id }}" id="track{{ $track->id }}">
                                            <label class="form-check-label" for="track{{ $track->id }}">
                                                {{ $track->title }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if($errors -> any())
    <h3>Возникла ошибка при создании плейлиста</h3>
    <ul>
    @foreach ($errors -> all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
@endsection
