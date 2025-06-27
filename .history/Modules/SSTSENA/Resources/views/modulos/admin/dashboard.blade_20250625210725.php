@extends('sstsena::layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold text-dark">Dashboard de Eventos de Seguridad y Salud</h1>
    <div class="card shadow-sm p-4 bg-gradient bg-light">
        <div class="d-flex justify-content-end align-items-center mb-4">
            <label for="yearSelect" class="form-label me-3 fw-semibold">Año:</label>
            <select id="yearSelect" class="form-select w-auto" onchange="updateChart()"></select>
        </div>
        <div id="chartdiv"></div>
    </div>
</div>

<!-- AmCharts resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<script>
const rawData = {
    accidents: [@foreach ($accidents as $a){ date_time: '{{ $a->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
    incidents: [@foreach ($incidents as $i){ date_time: '{{ $i->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
    emergencies: [@foreach ($emergencies as $e){ date_time: '{{ $e->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
    unsafeActs: [@foreach ($unsafeActs as $u){ date_time: '{{ $u->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach]
};

const colors = {
    accidents: am5.color(0xFF0000),
    incidents: am5.color(0x0066FF),
    emergencies: am5.color(0x00CC00),
    unsafeActs: am5.color(0xFF9900)
};

function processDataByMonth(data, year) {
    const months = moment.monthsShort();
    const result = months.map((month, index) => {
        const entry = { month };
        for (const type in data) {
            entry[type] = 0;
            data[type].forEach(item => {
                const date = moment(item.date_time);
                if (date.isValid() && date.year() == year && date.month() == index) {
                    entry[type]++;
                }
            });
        }
        return entry;
    });
    return result;
}

function getUniqueYears(data) {
    const years = new Set();
    for (const type in data) {
        data[type].forEach(item => {
            if (item.date_time) years.add(moment(item.date_time).year());
        });
    }
    return Array.from(years).sort();
}

let root;
function updateChart() {
    const year = document.getElementById('yearSelect').value;
    const data = processDataByMonth(rawData, year);

    if (root) root.dispose();

    root = am5.Root.new("chartdiv");

    // Puedes eliminar la animación completamente quitando esta línea o dejando solo el tema base si lo prefieres
    root.setThemes([am5themes_Animated.new(root)]); // Puedes comentar si no quieres ninguna transición

    const chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX: true
    }));

    const xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
        categoryField: "month",
        renderer: am5xy.AxisRendererX.new(root, {
            minGridDistance: 30,
            labels: {
                rotation: -45,
                centerX: am5.p100,
                centerY: am5.p50
            }
        })
    }));

    const yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        renderer: am5xy.AxisRendererY.new(root, {})
    }));

    const eventTypes = ["accidents", "incidents", "emergencies", "unsafeActs"];

    eventTypes.forEach(type => {
        const series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: type.charAt(0).toUpperCase() + type.slice(1),
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: type,
            categoryXField: "month",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{name}: {valueY}"
            })
        }));

        series.columns.template.setAll({
            tooltipText: "{name}: {valueY}",
            width: am5.percent(80),
            cornerRadiusTL: 6,
            cornerRadiusTR: 6,
            fill: colors[type],
            stroke: colors[type]
        });

        series.data.setAll(data);
        // series.appear(0);  ← quitamos esto
    });

    xAxis.data.setAll(data);
    // chart.appear(0, 0); ← quitamos esto
}

window.onload = function () {
    const years = getUniqueYears(rawData);
    const yearSelect = document.getElementById("yearSelect");
    yearSelect.innerHTML = years.map(y => `<option value="${y}">${y}</option>`).join('');
    yearSelect.value = years[years.length - 1];
    updateChart();
};
</script>
@endsection
