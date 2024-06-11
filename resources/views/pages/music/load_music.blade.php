@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Upload Music') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('music.create') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror mb-3" name="music[title]" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control-file @error('file') is-invalid @enderror mb-3" name="music[file]" required accept="audio/*">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cover" class="col-md-4 col-form-label text-md-right">{{ __('Cover') }}</label>

                                <div class="col-md-6">
                                    <input id="cover" type="file" class="form-control-file @error('cover') is-invalid @enderror mb-3" name="music[cover]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>

                                <div class="col-md-6">
                                    <input id="author" type="text" class="form-control @error('author') is-invalid @enderror mb-3" name="music[artist]" value="{{ old('author') }}" required autocomplete="author">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                                <div class="col-md-6">
                                    <input id="year" type="text" class="form-control @error('year') is-invalid @enderror mb-3" name="music[year]" value="{{ old('year') }}" required autocomplete="year">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Upload') }}
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
    <h3>Возникла ошибка при загрузки музыки</h3>
    <ul>
    @foreach ($errors -> all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
@endsection
