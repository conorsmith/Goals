@extends('form')

@section('title')
    Goals
@endsection

@section('action')
    {{ route('goals.update', ['all']) }}
@endsection

@section('fields')
    @foreach ($goals as $goal)
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="{{ $goal->slug }}" class="col-sm-2 control-label">{{ $goal->name }}</label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="{{ $goal->slug }}" name="{{ $goal->slug }}" value="{{ old($goal->slug, $goal->value) }}">
                    <span class="input-group-addon">{{ $goal->unit }}</span>
                </div>
            </div>
        </div>
    @endforeach
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Save Goals</button>
        </div>
    </div>
@endsection
