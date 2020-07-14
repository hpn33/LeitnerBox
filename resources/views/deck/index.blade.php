@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between">Decks
                        <form action="/decks/create" method="get">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>


                    <div class="card-body">

                        <deck-list></deck-list>

{{--                        <div class="row row-cols-3">--}}

{{--                            @foreach($decks as $deck)--}}
{{--                                <div class="col">--}}
{{--                                    <div class="card m-1">--}}
{{--                                        <div class="card-body card-text text-center h-100">--}}

{{--                                            <a href="{{ $deck->path() }}"><h5>{{ $deck->name }}</h5></a>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

{{--                        </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
