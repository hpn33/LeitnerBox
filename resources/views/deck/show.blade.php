@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $deck->name }}</div>

                    <div class="card-body">
                        {{ $deck->description }}
                        <form action="/decks/{{ $deck->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form action="/decks/{{ $deck->id }}/edit" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
