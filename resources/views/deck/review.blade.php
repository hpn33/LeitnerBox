@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($cards as $card)

                    <div class="card">
                        <div class="card-header d-flex ">
                            <a class="flex-grow-1" href="{{ $card->deck->path() }}">Back</a>
                            {{ request('page') ?? '1' }}/{{ $cardsCount }}
                        </div>

                        <div class="card-body text-center">
                            <p>
                                {{ $card->front }}
                            </p>
                            <hr>
                            <p>
                                {{ $card->back }}
                            </p>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $cards->links() }}
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
@endsection
