$(function () {
    $.ajax({
        url: 'backend/chart.json',
        dataType: 'json'
    }).done(function (data) {
        var labels = {
            created: "Unfixed",
            in_progress: "In Progress",
            fix_committed: "Fixed"
        };
        var colors = {
            created: "#dc322f",
            in_progress: "#2aa198",
            fix_committed: "#586e75"
        };

        var chart = {
            labels: [],
            datasets: [
                {
                    label: labels.fix_committed,
                    fillColor: colors.fix_committed,
                    data: []
                },
                {
                    label: labels.fix_committed,
                    fillColor: colors.in_progress,
                    data: []
                },
                {
                    label: labels.fix_committed,
                    fillColor: colors.created,
                    data: []
                }
            ]
        };

        for (var time in data) {
            var point = data[time];

            chart.labels.push(new Date(parseInt(time, 10) * 1000).toLocaleDateString());

            chart.datasets[0].data.push(point.fix_committed || 0);
            chart.datasets[1].data.push(point.in_progress || 0);
            chart.datasets[2].data.push(point.created || 0);
        }
        var lastPoint = point;

        var options = {
            animation: false,
            //responsive: true
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

        var $container = $('.doughnuts-ctn');

        for (var doughnutName in lastPoint) {
            var doughnutId = doughnutName.replace('_', '-');
            var ctx = document.getElementById(doughnutId+'-chart').getContext('2d');
            var fixedChart = new Chart(ctx).Doughnut([
                {
                    value: lastPoint[doughnutName],
                    color: colors[doughnutName],
                    label: labels[doughnutName]
                },
                {
                    value: total - lastPoint[doughnutName],
                    color: "rgba(0,0,0,0.12)",
                    label: "Other"
                }
            ], $.extend({
                segmentShowStroke: false,
                percentageInnerCutout: 90,
                showTooltips: false
            }, options));

            $container.find('.'+doughnutId+' .doughnut-count').text(lastPoint[doughnutName]);
        }
    });
});