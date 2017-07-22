/*jslint browser: true */
/*global $, Morris, google */
$(function () {
    "use strict";
    var resizeTimeout,
        drawChart = function drawChart() {
            $('.mdl-widget-gauge').each(function () {
                var chart,
                    $this = $(this),
                    $gauge = $this.find('.gauge').eq(0),
                    data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        ['Memory', parseFloat($this.find('.mdl-widget-source-value').val())]
                    ]);
                chart = new google.visualization.Gauge($gauge.empty().show().get(0));
                chart.draw(data, {
                    chartArea: {
                        width: '90%',
                        height: '90%'
                    },
                    width: '100%',
                    height: '100%',
                    redFrom: 90,
                    redTo: 100,
                    yellowFrom: 75,
                    yellowTo: 90,
                    minorTicks: 5
                });
            });
        },
        drawDoughnut = function drawDoughnut() {
            $('.mdl-widget-doughnut').each(function () {
                var chart,
                    $this = $(this),
                    $table = $this.find('.mdl-widget-source-table'),
                    header = $table.find('thead th').map(function () {
                        return $(this).text();
                    }).get(),
                    data = [
                        header
                    ];
                $table.find('tbody tr').each(function () {
                    var row = [];
                    $(this).find('td').each(function () {
                        var val = $(this).text();
                        if (!isNaN(val)) {
                            val = parseFloat(val);
                        }
                        row.push(val);
                    });
                    data.push(row);
                });
                chart = new google.visualization.PieChart($this.find('.chart').get(0));
                chart.draw(google.visualization.arrayToDataTable(data), {
                    pieHole: 0.4,
                    chartArea: {
                        width: '90%',
                        height: '80%'
                    },
                    width: '100%',
                    height: '100%',
                    colors: ['#99CA3C', '#E12010', '#D7760F']
                });
            });
        },
        drawPieChart = function drawPieChart() {
            $('.mdl-widget-pie-chart').each(function () {
                var chart,
                    $this = $(this),
                    $table = $this.find('.mdl-widget-source-table'),
                    header = $table.find('thead th').map(function () {
                        return $(this).text();
                    }).get(),
                    data = [
                        header
                    ];
                $table.find('tbody tr').each(function () {
                    var row = [];
                    $(this).find('td').each(function () {
                        var val = $(this).text();
                        if (!isNaN(val)) {
                            val = parseFloat(val);
                        }
                        row.push(val);
                    });
                    data.push(row);
                });
                chart = new google.visualization.PieChart($this.find('.chart').get(0));
                chart.draw(google.visualization.arrayToDataTable(data), {
                    chartArea: {
                        width: '90%',
                        height: '80%'
                    },
                    width: '100%',
                    height: '100%',
                    colors: $table.find('tbody tr').map(function () {
                        return $(this).css('backgroundColor');
                    }).get()
                });
            });
        },
        drawChart2 = function drawChart2() {
            //mdl-widget-column-chart
            $('.mdl-widget-stacked-column-chart').each(function () {
                var $this = $(this),
                    chart2 = new google.visualization.ColumnChart($this.find('.chart').get(0)),
                    $table = $this.find('.mdl-widget-source-table'),
                    header = $table.find('thead th').map(function () {
                        return $(this).text();
                    }).get().concat({
                        role: 'annotation'
                    }),
                    data2 = [
                        header
                    ];
                $table.find('tbody tr').each(function () {
                    var row = [];
                    $(this).find('td').each(function () {
                        var val = $(this).text();
                        if (!isNaN(val)) {
                            val = parseFloat(val);
                        }
                        row.push(val);
                    });
                    row.push('');//one more value as a label on top, that we don't need though
                    data2.push(row);
                });
                chart2.draw(google.visualization.arrayToDataTable(data2), {
                    isStacked: true,
                    width: '100%',
                    height: '100%',
                    legend: {
                        position: 'top',
                        maxLines: 3
                    },
                    yAxis: {
                        minValue: 0
                    },
                    bar: {
                        groupWidth: '75%'
                    },
                    colors: $table.find('thead th').map(function () {
                        return $(this).css('backgroundColor');
                    }).get().slice(1)//remove first column as it is the annotation
                });
            });
        },
        drawColumn = function drawColumn() {
            $('.mdl-widget-column-chart').each(function () {
                var chart, view,
                    color = '#272D71',
                    $this = $(this),
                    $table = $this.find('.mdl-widget-source-table'),
                    header = $table.find('thead th').map(function () {
                        return $(this).text();
                    }).get().concat({
                        role: 'style'
                    }),
                    data = [
                        header
                    ];
                $table.find('tbody tr').each(function () {
                    var d = [];
                    $(this).find('td').each(function (i) {
                        var r = $(this).text();
                        if (!isNaN(r)) {
                            r = parseFloat(r);
                        }
                        d[i] = r;
                    });
                    d.push(color);
                    data.push(d);
                });
                view = new google.visualization.DataView(google.visualization.arrayToDataTable(data));
                view.setColumns([0, 1, {
                    calc: 'stringify',
                    sourceColumn: 1,
                    type: 'string',
                    role: 'annotation'
                }, 2]);
                chart = new google.visualization.ColumnChart($this.find('.box-body').get(0));
                chart.draw(view, {
                    chartArea: {
                        width: '100%',
                        height: '70%'
                    },
                    width: '100%',
                    height: '100%',
                    fontSize: 7,
                    bar: {
                        groupWidth: '90%'
                    },
                    legend: {
                        position: 'none'
                    }
                });
            });
        },
        drawColumn4 = function drawColumn4() {
            $('.mdl-widget-colored-column-chart').each(function () {
                var chart, view,
                    getColor = function getColor(val) {
                        //fix this maybe
                        if (val === 'same') {
                            return '#5866FF';
                        }
                        if (val.indexOf('-') === 0) {
                            return '#E12010';
                        }
                        return '#99ca3c';
                    },
                    $this = $(this),
                    $table = $this.find('.mdl-widget-source-table'),
                    header = $table.find('thead th').map(function () {
                        return $(this).text();
                    }).get().concat({
                        role: 'style'
                    }),
                    data = [
                        header
                    ];
                $table.find('tbody tr').each(function () {
                    var row = [];
                    $(this).find('td').each(function () {
                        var val = $(this).text();
                        if (!isNaN(val)) {
                            val = parseFloat(val);
                        }
                        row.push(val);
                    });
                    row.push(getColor(row[0]));//color depends on the first value
                    data.push(row);
                });
                view = new google.visualization.DataView(google.visualization.arrayToDataTable(data));
                view.setColumns([0, 1, {
                    calc: 'stringify',
                    sourceColumn: 1,
                    type: 'string',
                    role: 'annotation'
                }, 2]);
                chart = new google.visualization.ColumnChart($this.find('.chart').get(0));
                chart.draw(view, {
                    fontSize: 9,
                    vAxis: {
                        title: 'Number of Products',
                        slantedText: true,
                        slantedTextAngle: 90,
                        gridlines: {
                            count: 0
                        }
                    },
                    bar: {
                        groupWidth: '90%'
                    },
                    legend: {
                        position: 'none'
                    }
                });
            });
        },
        drawMap = function drawmap() {
            var options = {
                    height: 400,
                    dataMode: 'regions'
                };
            $('.mdl-widget-map').each(function () {
                var geomap,
                    $this = $(this),
                    $table = $this.find('.mdl-widget-source-table'),
                    header = $table.find('thead th').map(function () {
                        return $(this).text();
                    }).get(),
                    data = [
                        header
                    ];

                geomap = new google.visualization.GeoMap($this.find('.chart').get(0));
                $table.find('tbody tr').each(function () {
                    data.push($(this).find('td').map(function () {
                        var val = $(this).text();
                        if (!isNaN(val)) {
                            return parseFloat(val);
                        }
                        return val;
                    }).get());
                });
                geomap.draw(google.visualization.arrayToDataTable(data), options);
            });
        },
        drawArea = function drawArea() {
            $('.mdl-widget-area').each(function () {
                var data2 = [],
                    $table = $(this).find('table'),
                    header = $table.find('thead tr th').map(function () {
                        return $(this).text();
                    }).get(),
                    labels = header.slice(1);
                $table.find('tbody').find('tr').each(function () {
                    var row = {};
                    $(this).find('td').each(function (i) {
                        row[header[i]] = $(this).text();
                    });
                    data2.push(row);
                });
                new Morris.Area({
                    element: $(this).find('.chart').get(0),
                    resize: true,
                    data: data2,
                    xkey: header[0],
                    ykeys: labels,
                    labels: labels,
                    lineColors: ['#a0d0e0', '#3c8dbc'],
                    hideHover: 'auto'
                });
            });
        },
        draw = function draw() {
            drawChart();
            drawColumn();
            drawDoughnut();
            drawPieChart();
            drawChart2();
            drawColumn4();
            drawMap();
            resizeTimeout = false;
        };
    $('.connectedSortable').sortable({
        connectWith: '.connectedSortable',
        appendTo: 'body',
        opacity: 0.8,
        placeholder: 'sort-highlight',
        tolerance: 'pointer',
        forcePlaceholderSize: true,
        cursor: 'move',
        dropOnEmpty: true,
        helper: 'clone',
        zIndex: 999999,
        stop: function (e, ui) {
            var widgets = {},
                url = $('#save-order-url').val(),
                $div = ui.item,
                $parent = $div.closest('.connectedSortable'),
                parentId = $parent.attr('id');
            $parent.find('.mdl-widget').map(function () {
                var $w = $(this);
                widgets[$w.data('widgetId')] = $w.index();
            });
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: {
                    widgets: widgets,
                    parent: parentId
                }
            });
        }
    });
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5();
    google.charts.load('current', {
        packages: ['gauge', 'corechart', 'bar', 'geomap']
    });

    google.charts.setOnLoadCallback(draw);
    drawArea();
    $('.ui-sortable').sortable({
        update: draw
    });
    $(window).resize(function () {
        if (resizeTimeout) {
            clearTimeout(resizeTimeout);
        }
        resizeTimeout = setTimeout(draw, 300);
    });
    $('.restore-scenarios').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).data('url'),
            method: 'POST',
            data: {
                ids: $('.mdl-widget').map(function () {
                    return $(this).data('widgetId');
                }).get()
            }
        }).then(function () {
            $.ajax().then(function (html) {
                $('.content').html($(html).find('.content').html());
                draw();
            });
        });
    });
});
