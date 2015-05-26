@extends('table')

@section('table')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ ucfirst($sport) }} Records
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th style="text-align: right;">Distance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workouts as $workout)
                    <tr>
                        <td style="width: 160px;">{{ $workout->exercised_at->tz($timezone)->format('Y-m-d (D)') }}
                        <td style="width: 80px;">{{ $workout->exercised_at->tz($timezone)->format('H:i') }}</td>
                        <td style="text-align: right;">{{ $workout->distance }}km</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection