(function () {
    var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "#586e75",
                //strokeColor: "rgba(220,220,220,0.8)",
                //highlightFill: "rgba(220,220,220,0.75)",
                //highlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40, 19, 86, 27, 90, 65, 59, 80]
            },
            {
                label: "My Second dataset",
                fillColor: "#2aa198",
                //strokeColor: "rgba(151,187,205,0.8)",
                //highlightFill: "rgba(151,187,205,0.75)",
                //highlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86, 27, 90, 65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "My Third dataset",
                fillColor: "#dc322f",
                //strokeColor: "rgba(151,187,205,0.8)",
                //highlightFill: "rgba(151,187,205,0.75)",
                //highlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86, 27, 90, 19, 86, 27, 90, 65, 59, 80]
            }
        ]
    };

    var options = {
        animation: false,
        //responsive: true,
        showScale: false,
        showTooltips: false,
        barShowStroke: false
    };

    var ctx = document.getElementById('roadmap-chart').getContext('2d');
    var barChart = new Chart(ctx).StackedBar(data, options);

})();