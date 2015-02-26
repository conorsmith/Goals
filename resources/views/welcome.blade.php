<html>
	<head>
	    <title>Goals</title>

	    <link href="/css/app.css" rel="stylesheet">
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>Goals</h1>
			</div>
			<div>
			    @foreach ($goals as $goal)
			        <div class="row" style="margin-bottom: 20px;">
			            <div class="col-sm-2" style="text-align: center;">
			                <div><img src="http://placehold.it/100x100" class="img-circle"></div>
			                <div>{{ $goal->getName() }}</div>
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
			                {{--
			                <div class="row">
			                    @foreach ($goal->getProgress()->getMeasurementsForEachMonth() as $measurement)
                                    <div class="col-sm-1">
                                        <div>
                                            <div class="progress" style="height: 80px;">
                                                <div class="progress-bar progress-bar-info" style="width: 100%; height: {{ $measurement->getPercentage() }}%;"></div>
                                            </div>
                                        </div>
                                        <div style="text-align: center;">
                                            {{ $measurement->getValue() }}
                                        </div>
                                        <div style="text-align: center;">
                                            {{ $measurement->getPeriod() }}
                                        </div>
                                    </div>
                                @endforeach
			                </div>
			                --}}
			            </div>
			            <div class="col-sm-2" style="text-align: center;">
			                <div>{{ number_format($goal->getValue()) }}</div>
			                <div>{{ $goal->getUnit() }}</div>
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
