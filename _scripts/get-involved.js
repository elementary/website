/**
 * _scripts/get-involved.js
 * Creates the desktop bugs burn down chart
 */

import Promise from 'core-js/fn/promise'

import ChartPromise from '~/lib/chart'
import jQuery from '~/lib/jquery'

Promise.all([ChartPromise, jQuery]).then(([Chart, $]) => {
    $(function () {
        var dateYearMonthDay = new Date().toISOString().substring(0, 10)
        var preventingCacheSuffix = '?' + dateYearMonthDay
        $.ajax({
            url: 'backend/chart.json' + preventingCacheSuffix,
            dataType: 'json'
        }).done(function (data) {
            var labels = {
                created: 'Unfixed',
                in_progress: 'In Progress',
                fixed: 'Fixed'
            }
            var colors = {
                created: '#dc322f',
                in_progress: '#2aa198',
                fixed: '#586e75'
            }

            var chart = {
                labels: [],
                datasets: [{
                    label: labels.created,
                    backgroundColor: colors.created,
                    data: []
                }, {
                    label: labels.in_progress,
                    backgroundColor: colors.in_progress,
                    data: []
                }, {
                    label: labels.fixed,
                    backgroundColor: colors.fixed,
                    data: []
                }]
            }

            var currentYear = new Date().getFullYear()

            for (var time in data) {
                var date = new Date(parseInt(time, 10) * 1000)

                var dateFormatOptions = { month: 'long', day: 'numeric' }
                if (currentYear !== date.getFullYear()) {
                    dateFormatOptions = { year: 'numeric', month: 'long', day: 'numeric' }
                }

                var dateLocalized = date.toLocaleDateString(document.documentElement.lang, dateFormatOptions)

                var point = data[time]
                $.extend(point, { date: dateLocalized })

                chart.labels.push(dateLocalized)

                chart.datasets[0].data.push(point.created || 0)
                chart.datasets[1].data.push(point.in_progress || 0)
                chart.datasets[2].data.push(point.fixed || 0)
            }
            var lastPoint = point

            var options = {
                animation: {
                    duration: 20,
                    easing: 'easeOutQuint'
                },
                responsive: true
            }

            var $chart = $('.charts .barchart-ctn canvas')

            $chart.mouseout(function () {
                updateDoughnuts()
            })

            var ctx = $chart[0].getContext('2d')
            // eslint-disable-next-line no-new
            new Chart(ctx, {
                type: 'bar',
                data: chart,
                options: $.extend({
                    title: { display: false },
                    legend: { display: false },
                    scales: {
                        xAxes: [{
                            display: false,
                            stacked: true
                        }],
                        yAxes: [{
                            display: false,
                            stacked: true
                        }]
                    },
                    tooltips: {
                        backgroundColor: 'rgba(0, 0, 0, 0)',
                        callbacks: {
                            title: () => null,
                            label: function (data) {
                                var point = {
                                    date: data.xLabel,
                                    created: parseInt(this._data.datasets[0].data[data.index], 10),
                                    in_progress: parseInt(this._data.datasets[1].data[data.index], 10),
                                    fixed: parseInt(this._data.datasets[2].data[data.index], 10)
                                }

                                updateDoughnuts(point)
                            }
                        }
                    }
                }, options)
            })

            var $container = $('.doughnuts-ctn')
            function updateDoughnuts (point) {
                if (!point) {
                    point = lastPoint
                }
                $container.find('#date').text(point.date)

                var total = point.created + point.in_progress + point.fixed

                for (var doughnutName in doughnutCharts) {
                    var doughnutId = doughnutName.replace('_', '-')

                    $container.find('.' + doughnutId + ' .doughnut-count').text(point[doughnutName])

                    doughnutCharts[doughnutName].data.datasets[0].data = [point[doughnutName], total - point[doughnutName]]

                    doughnutCharts[doughnutName].update()
                }
            }

            lastPoint.created = lastPoint.created || 0
            lastPoint.in_progress = lastPoint.in_progress || 0
            lastPoint.fixed = lastPoint.fixed || 0

            var doughnutCharts = {}
            for (var doughnutName in lastPoint) {
                if (doughnutName === 'date') {
                    continue
                }

                var doughnutId = doughnutName.replace('_', '-')
                var ctxt = document.getElementById(doughnutId + '-chart').getContext('2d')
                doughnutCharts[doughnutName] = new Chart(ctxt, {
                    type: 'doughnut',
                    data: {
                        labels: [],
                        datasets: [{
                            backgroundColor: [
                                colors[doughnutName],
                                'rgba(0,0,0,0.12)'
                            ],
                            borderWidth: [0, 0],
                            data: [0, 1],
                            hoverBackgroundColor: [
                                colors[doughnutName],
                                'rgba(0,0,0,0.12)'
                            ],
                            label: labels[doughnutName]
                        }]
                    },
                    options: $.extend({
                        segmentShowStroke: false,
                        cutoutPercentage: 90,
                        tooltips: {
                            enabled: false
                        }
                    }, options)
                })
            }

            updateDoughnuts()
        })
    })
})
