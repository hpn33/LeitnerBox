@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Deck: <a href="{{ $card->deck->path() }}">{{ $card->deck->name }}</a>

                        <form action="{{ $card->path() }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                        <a href="{{ $card->path('edit') }}">Edit</a>

                    </div>

                    <div class="card-body">
                        <p>
                            {{ $card->front }}
                        </p>
                        <hr>
                        <p>
                            {{ $card->back }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
