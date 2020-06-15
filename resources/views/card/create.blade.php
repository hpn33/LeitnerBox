@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Card</div>

                    <div class="card-body">
                        <form method="post" action="{{ $deck->path('card') }}">
                            @csrf

                            <div class="form-group">
                                <label for="front">Front</label>
                                <textarea name="front" id="front" class="form-control"
                                          rows="8">{{ old('front') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="back">Back</label>
                                <textarea name="back" id="back" class="form-control"
                                          rows="8">{{ old('back') }}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="{{ $deck->path() }}">Back</a>
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
