@extends('form')

@section('title')
    Log Weight
@endsection

@section('action')
    {{ route('log.weight.store') }}
@endsection

@section('fields')
    <div class="form-group">
        <label for="date" class="col-sm-2 control-label">Date</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
        </div>
    </div>
    <div class="form-group">
        <label for="measurement" class="col-sm-2 control-label">Measurement</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="measurement" name="measurement" value="{{ old('measurement') }}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Log Weight</button>
        </div>
    </div>
@endsection
