@extends('form')

@section('title')
    Log {{ ucfirst($sport) }}
@endsection

@section('action')
    {{ route('log.exercise.store', [$sport]) }}
@endsection

@section('fields')
    <div class="form-group">
        <label for="workout_file" class="col-sm-2 control-label">Workout File</label>
        <div class="col-sm-10">
            <input type="file" id="workout_file" name="workout_file[]" multiple="multiple">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Log {{ ucfirst($sport) }}</button>
        </div>
    </div>
@endsection

