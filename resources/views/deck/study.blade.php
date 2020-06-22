@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <study-card deck_id="{{ $deck_id }}"></study-card>

            </div>
        </div>
    </div>
@endsection
