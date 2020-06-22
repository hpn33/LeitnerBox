@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex flex-row">
                        <div class="flex-grow-1">
                            <a href="{{ $deck->path() }}">{{ $deck->name }}</a>
                        </div>

                        <div class="d-flex flex-row">

                        </div>
                    </div>

                    <div class="card-body text-center">
                        <p>
                            {{ $deck->study_card->front }}
                        </p>
                        <hr>
                        <p>
                            {{ $deck->study_card->back }}
                        </p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a class="btn" href="{{ $deck->path('study/'. $deck->study_card->id .'?p=again') }}">again</a>

                        <a class="btn" href="{{ $deck->path('study/'. $deck->study_card->id .'?p=good') }}">good</a>

                        <a class="btn " href="{{ $deck->path('study/'. $deck->study_card->id .'?p=easy') }}">easy</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
