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
            animation: true,
            animationSteps: 20,
            animationEasing: 'easeOutQuint',
            responsive: true
        };

        var $chart = $('.charts .barchart-ctn canvas');

        $chart.mouseout(function () {
            updateDoughnuts();
        });

        var ctx = $chart[0].getContext('2d');
        var barChart = new Chart(ctx).StackedBar(chart, $.extend({
            showScale: false,
            barShowStroke: false,
            barValueSpacing: 0,
            customTooltips: function (tooltip) {
                if (!tooltip) {
                    return;
                }

                var point = {
                    fix_committed: parseInt(tooltip.labels[0], 10),
                    in_progress: parseInt(tooltip.labels[1], 10),
                    created: parseInt(tooltip.labels[2], 10)
                };

                updateDoughnuts(point);
            }
        }, options));

        var $container = $('.doughnuts-ctn');
        function updateDoughnuts(point) {
            if (!point) {
                point = lastPoint;
            }

            var total = point.created + point.in_progress + point.fix_committed;

            for (var doughnutName in doughnutCharts) {
                var doughnutId = doughnutName.replace('_', '-');

                $container.find('.'+doughnutId+' .doughnut-count').text(point[doughnutName]);

                doughnutCharts[doughnutName].segments[0].value = point[doughnutName];
                doughnutCharts[doughnutName].segments[1].value = total - point[doughnutName];
                doughnutCharts[doughnutName].update();
            }
        }

        lastPoint.created = lastPoint.created || 0;
        lastPoint.in_progress = lastPoint.in_progress || 0;
        lastPoint.fix_committed = lastPoint.fix_committed || 0;

        var doughnutCharts = {};
        for (var doughnutName in lastPoint) {
            var doughnutId = doughnutName.replace('_', '-');

            var ctx = document.getElementById(doughnutId+'-chart').getContext('2d');
            doughnutCharts[doughnutName] = new Chart(ctx).Doughnut([
                {
                    value: 1,
                    color: colors[doughnutName],
                    label: labels[doughnutName]
                },
                {
                    value: 1,
                    color: "rgba(0,0,0,0.12)",
                    label: "Other"
                }
            ], $.extend({
                segmentShowStroke: false,
                percentageInnerCutout: 90,
                showTooltips: false
            }, options));
        }

        updateDoughnuts();
    });
});