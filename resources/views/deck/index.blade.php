@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Decks
                        <form action="/decks/create" method="get">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>


                    <div class="card-body">

                        @foreach($decks as $deck)
                            <a href="{{ $deck->path() }}"><h5>{{ $deck->name }}</h5></a>
                            {{ $deck->description }}
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
