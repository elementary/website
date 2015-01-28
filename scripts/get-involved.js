$(function () {
    $.ajax({
        url: 'backend/chart.json',
        dataType: 'json'
    }).done(function (data) {
        var chart = {
            labels: [],
            datasets: [
                {
                    label: "Fixed",
                    fillColor: "#586e75",
                    data: []
                },
                {
                    label: "In Progress",
                    fillColor: "#2aa198",
                    data: []
                },
                {
                    label: "Unfixed",
                    fillColor: "#dc322f",
                    data: []
                }
            ]
        };

        for (var time in data) {
            var point = data[time];

            chart.labels.push(time);

            chart.datasets[0].data.push(point.fix_committed || 0);
            chart.datasets[1].data.push(point.in_progress || 0);
            chart.datasets[2].data.push(point.created || 0);
        }
        var lastPoint = point;

        var options = {
            animation: false,
            //responsive: true,
            showTooltips: false
        };

        var ctx = document.getElementById('roadmap-chart').getContext('2d');
        var barChart = new Chart(ctx).StackedBar(chart, $.extend({
            showScale: false,
            barShowStroke: false,
            barValueSpacing: 2
        }, options));

        lastPoint.created = lastPoint.created || 0;
        lastPoint.in_progress = lastPoint.in_progress || 0;
        lastPoint.fix_committed = lastPoint.fix_committed || 0;
        var total = lastPoint.created + lastPoint.in_progress + lastPoint.fix_committed;

        var colors = {
            created: "#dc322f",
            in_progress: "#2aa198",
            fix_committed: "#586e75"
        };
        for (var doughnutName in lastPoint) {
            var doughnutId = doughnutName.replace('_', '-')+'-chart';
            var ctx = document.getElementById(doughnutId).getContext('2d');
            var fixedChart = new Chart(ctx).Doughnut([
                {
                    value: lastPoint[doughnutName],
                    color: colors[doughnutName]
                },
                {
                    value: total - lastPoint[doughnutName],
                    color: "rgba(0,0,0,0.12)"
                }
            ], $.extend({
                segmentShowStroke: false,
                percentageInnerCutout: 90
            }, options));
        }
        
    });
});