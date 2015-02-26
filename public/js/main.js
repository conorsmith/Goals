$(function() {

    $('.js__month-chart').each(function () {
        $(this).highcharts({
            chart: {
                type: 'column',
                height: 180
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: null
                },
                labels: {
                    formatter: function() {
                        return this.value + '%';
                    }
                },
                plotLines: [
                    {
                        color: 'red',
                        value: 100,
                        width: 1,
                        zIndex: 5
                    }
                ]
            },
            legend: {
                enabled: false
            },
            tooltip: {
                enabled: false
            },
            series: [
                {
                    name: "Progress",
                    data: $(this).data('progress'),
                    color: '#337ab7'
                }
            ],
            plotOptions: {
                column: {
                    pointPadding: 0,
                    groupPadding: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return this.point.name == 0 ? '' : this.point.name;
                        },
                        zIndex: 10
                    }
                }
            }
        });
    });

});
