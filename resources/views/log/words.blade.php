@extends('form')

@section('title')
    Log Words Written
@endsection

@section('action')
    {{ route('log.words.store') }}
@endsection

@section('fields')
    <div class="form-group">
        <label for="date" class="col-sm-2 control-label">Date</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
        </div>
    </div>
    <div class="form-group">
        <label for="word_count" class="col-sm-2 control-label">Word Count</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="word_count" name="word_count" value="{{ old('word_count') }}">
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Log Words Written</button>
        </div>
    </div>
@endsection
