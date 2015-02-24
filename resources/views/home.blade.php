@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
		    @if (Session::has('message'))
		        @if (is_array(Session::get('message')))
		            <div class="alert alert-success">
		                @foreach (Session::get('message') as $message)
		                    <p>{{ $message }}</p>
		                @endforeach
		            </div>
		        @else
		            <div class="alert alert-success">{{ Session::get('message') }}</div>
		        @endif
		    @endif
		    @if (!$has_access_token)
		        <div class="alert alert-warning">The application does not have an access token for the Google Drive API. <a href="{{ route('oauth.trigger', ['google']) }}" class="alert-link">Click to authenticate</a>.</div>
		    @endif
			<div class="panel panel-default">
				<div class="panel-heading">Log Goal Activities</div>

				<div class="panel-body">
				    <div class="row">
				        <div class="col-md-4" style="margin-bottom: 16px;">
				            <a href="{{ route('log.exercise.create', ['running']) }}" class="btn btn-default btn-block btn-lg">Log Run</a>
				        </div>
				        <div class="col-md-4" style="margin-bottom: 16px;">
				            <a href="{{ route('log.exercise.create', ['walking']) }}" class="btn btn-default btn-block btn-lg">Log Walk</a>
				        </div>
				        <div class="col-md-4" style="margin-bottom: 16px;">
				            <a href="{{ route('log.weight.create') }}" class="btn btn-default btn-block btn-lg">Log Weight</a>
				        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom: 16px;">
                            <a href="{{ route('log.achievement.create', ['recipe-learned']) }}" class="btn btn-default btn-block btn-lg">Log Recipe Learned</a>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 16px;">
                            <a href="{{ route('log.albums.create') }}" class="btn btn-default btn-block btn-lg">Log Albums</a>
                        </div>
                        <div class="col-md-4" style="margin-bottom: 16px;">
                            <a href="{{ route('log.rangedachievement.create', ['book-read']) }}" class="btn btn-default btn-block btn-lg">Log Book Read</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4" style="margin-bottom: 16px;">
                            <a href="{{ route('log.words.create') }}" class="btn btn-default btn-block btn-lg">Log Words Written</a>
                        </div>
                    </div>
                    <hr>
					<a href="{{ route('goals.index') }}" class="btn btn-default btn-block btn-lg">Edit Goals</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
