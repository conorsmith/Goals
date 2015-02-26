<html>
	<head>
	    <title>Goals 2015</title>

	    <link href="/css/app.css" rel="stylesheet">
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

	</head>
	<body>
		<div class="container">
			<div class="page-header" style="text-align: center;">
				<h1>Goals 2015</h1>
			</div>
			<div>
			    @foreach ($goals as $goal)
			        <div class="row" style="margin-bottom: 20px;">
			            <div class="col-sm-2" style="text-align: center;">
			                <div style="height: 120px;"><img src="http://placehold.it/120x120" class="img-circle"></div>
			                <div style="margin-top: 20px; font-size: 18px; font-weight: bold;">{{ $goal->getName() }}</div>
			            </div>
			            <div class="col-sm-8">
			                <div class="progress" style="height: 60px; line-height: 60px; text-align: left; font-weight: bold;">
			                    <div class="progress-bar" style="height: 60px; line-height: 60px; text-align: right; font-size: 14px; padding-right: 16px; width: {{ $goal->getProgress()->getMeasurementForTheYear()->getPercentage() }}%;">
			                        @if ($goal->getProgress()->getMeasurementForTheYear()->getPercentage() >= 25)
			                            {{ $goal->getProgress()->getMeasurementForTheYear()->getValue() }} {{ $goal->getUnit() }}
			                        @endif
			                    </div>
			                    <div style="padding-left: 14px; float: left;">
                                    @if ($goal->getProgress()->getMeasurementForTheYear()->getPercentage() < 25)
                                        {{ $goal->getProgress()->getMeasurementForTheYear()->getValue() }} {{ $goal->getUnit() }}
                                    @endif
                                </div>
			                </div>
			                <div class="js__month-chart" data-progress="{{ $goal->getProgress()->getMonthlyProgressAsJson() }}"></div>
			            </div>
			            <div class="col-sm-2" style="text-align: center;">
			                <div style="font-size: 48px; font-weight: bold;">{{ number_format($goal->getValue()) }}</div>
			                <div style="font-size: 16px; line-height: 12px;">{{ $goal->getUnit() }}</div>
			            </div>
			        </div>
			        <hr>
			    @endforeach
			</div>
		</div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//code.highcharts.com/highcharts.js"></script>
		<script src="/js/main.js"></script>
	</body>
</html>
