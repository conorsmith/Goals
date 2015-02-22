@extends('form')

@section('title')
    Log Albums
@endsection

@section('action')
    {{ route('log.albums.store') }}
@endsection

@section('fields')
    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-default">Update from Google Sheets</button>
        </div>
    </div>
@endsection
