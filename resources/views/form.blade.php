@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		    <div class="page-header">
		        <h1>@yield('title', "Form")</h1>
		    </div>
		    @if ($errors->any())
		        <div class="alert alert-danger">
		            @foreach ($errors->all() as $error)
		                <p>{{ $error }}</p>
		            @endforeach
		        </div>
		    @endif
            <form class="form-horizontal" method="POST" action="@yield('action', "")" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @yield('fields')
            </form>
		</div>
	</div>
</div>
@endsection
