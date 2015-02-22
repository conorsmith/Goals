@extends('form')

@section('title')
    Log {{ ucwords(str_replace('-', ' ', $label)) }}
@endsection

@section('action')
    {{ route('log.rangedachievement.store', [$label]) }}
@endsection

@section('fields')
    <div class="form-group">
        <label for="from_date" class="col-sm-2 control-label">Date Range</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="from_date" name="from_date" value="{{ old('from_date') }}">
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="to_date" name="to_date" value="{{ old('to_date', date('Y-m-d')) }}">
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
