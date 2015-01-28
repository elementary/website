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
                    //strokeColor: "rgba(220,220,220,0.8)",
                    //highlightFill: "rgba(220,220,220,0.75)",
                    //highlightStroke: "rgba(220,220,220,1)",
                    data: []
                },
                {
                    label: "In Progress",
                    fillColor: "#2aa198",
                    //strokeColor: "rgba(151,187,205,0.8)",
                    //highlightFill: "rgba(151,187,205,0.75)",
                    //highlightStroke: "rgba(151,187,205,1)",
                    data: []
                },
                {
                    label: "Unfixed",
                    fillColor: "#dc322f",
                    //strokeColor: "rgba(151,187,205,0.8)",
                    //highlightFill: "rgba(151,187,205,0.75)",
                    //highlightStroke: "rgba(151,187,205,1)",
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

        var options = {
            animation: false,
            //responsive: true,
            showScale: false,
            showTooltips: false,
            barShowStroke: false,
            barValueSpacing: 2
        };

        var ctx = document.getElementById('roadmap-chart').getContext('2d');
        var barChart = new Chart(ctx).StackedBar(chart, options);
    });
});