@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="list-group">
				    <a href="{{ route('records.exercise', ['running']) }}" class="list-group-item">Runs</a>
				    <a href="{{ route('records.exercise', ['walking']) }}" class="list-group-item">Walks</a>
				    <a href="#" class="list-group-item">Weight</a>
				    <a href="#" class="list-group-item">Recipes</a>
				    <a href="#" class="list-group-item">Albums</a>
				    <a href="#" class="list-group-item">Books</a>
				    <a href="#" class="list-group-item">Words</a>
				</div>
			</div>
		</div>
		<div class="col-md-10">
		    @yield('table', "")
		</div>
	</div>
</div>
@endsection
