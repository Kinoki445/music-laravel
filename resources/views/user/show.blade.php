@extends('layouts.app')
@extends('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <h2>User {{ $user->name }}</h2>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">User Information</h5>
            <p class="card-text">
                Name: {{ $user->name }}<br>
                Email: {{ $user->email }}<br>
                Uploaded Tracks:
                <div class="row">
                    @foreach($music as $track)
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
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </p>
        </div>
    </div>
</div>


@endsection
