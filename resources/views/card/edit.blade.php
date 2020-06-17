@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Deck</div>

                    <div class="card-body">
                        <form action="{{ $card->path() }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form method="post" action="{{ $card->path() }}">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="front">Front</label>
                                <input class="form-control" id="front" name="front" value="{{ old('front') ?? $card->front }}" required>
                            </div>

                            <div class="form-group">
                                <label for="back">Back</label>
                                <textarea name="back" id="back" class="form-control"
                                          rows="8">{{ old('description') ?? $card->back }}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ $card->path() }}">Back</a>
                            </div>

                            @if (count($errors))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
