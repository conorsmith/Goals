@extends('form')

@section('title')
    Log {{ ucwords(str_replace('-', ' ', $label)) }}
@endsection

@section('action')
    {{ route('log.achievement.store', [$label]) }}
@endsection

@section('fields')
    <div class="form-group">
        <label for="date" class="col-sm-2 control-label">Date</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Log {{ ucwords(str_replace('-', ' ', $label)) }}</button>
        </div>
    </div>
@endsection
