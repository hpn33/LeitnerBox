@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex flex-row">
                        <div class="flex-grow-1"> {{ $deck->name }}</div>
                        <div class="d-flex flex-row">


                            <form action="{{ $deck->path() }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a class="btn" href="{{ $deck->path('edit') }}">Edit</a>

                            <a class="btn" href="{{ $deck->path('create') }}">Add Card</a>
                            <a class="btn " href="{{ $deck->path('review') }}">Review</a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{ $deck->description }}
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header d-flex">

                        <div class="flex-grow-1">
                            Cards
                        </div>
                        <a href="{{ $deck->path('create') }}">Add Card</a>
                    </div>

                    <div class="card-body">
                        <div class="row row-cols-3">

                            @foreach($deck->cards as $card)
                                <div class="col">
                                    <div class="card m-1">
                                        <div class="card-body card-text text-center">
                                            <p>
                                                {{ $card->front }}
                                            </p>
                                            <hr>
                                            <p>
                                                {{ $card->back }}
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <form action="{{ $card->path() }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                            <a href="{{ $card->path('edit') }}">Edit</a>
                                            <a href="{{ $card->path() }}">Show</a>


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
