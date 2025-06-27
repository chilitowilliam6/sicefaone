@extends('sstsena::layouts.master')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6 font-sans">
    <h1 class="text-center text-3xl font-bold text-gray-800 mb-6">Dashboard de Eventos SST</h1>

    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="flex justify-end mb-4">
            <select id="yearSelect" onchange="updateChart()" class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </select>
        </div>
        <div class="relative h-[400px]">
            <canvas id="eventsChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<script>
    const rawData = {
        accidents: [@foreach ($accidents as $a){ date_time: '{{ $a->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        incidents: [@foreach ($incidents as $i){ date_time: '{{ $i->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        emergencies: [@foreach ($emergencies as $e){ date_time: '{{ $e->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        unsafeActs: [@foreach ($unsafeActs as $u){ date_time: '{{ $u->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach]
    };

    const colors = {
        accidents: '#ef4444',
        incidents: '#3b82f6',
        emergencies: '#06b6d4',
        unsafeActs: '#f97316'
    };

    const processData = (data, year) => {
        const counts = { accidents: Array(12).fill(0), incidents: Array(12).fill(0), emergencies: Array(12).fill(0), unsafeActs: Array(12).fill(0) };
        ['accidents','incidents','emergencies','unsafeActs'].forEach(type => {
            data[type].forEach(i => {
                const d = moment(i.date_time);
                if (d.isValid() && d.year() === +year) counts[type][d.month()]++;
            });
        });
        return counts;
    };

    const getYears = data => {
        const years = new Set();
        Object.values(data).flat().forEach(i => i.date_time && years.add(moment(i.date_time).year()));
        return Array.from(years).sort();
    };

    let chart;
    const updateChart = () => {
        const year = document.getElementById('yearSelect').value;
        const { accidents, incidents, emergencies, unsafeActs } = processData(rawData, year);
        const ctx = document.getElementById('eventsChart');
        if (chart) chart.destroy();

        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: moment.monthsShort(),
                datasets: [
                    { label: 'Accidentes', data: accidents, backgroundColor: colors.accidents },
                    { label: 'Incidentes', data: incidents, backgroundColor: colors.incidents },
                    { label: 'Emergencias', data: emergencies, backgroundColor: colors.emergencies },
                    { label: 'Actos Inseguros', data: unsafeActs, backgroundColor: colors.unsafeActs }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: { display: true, text: `Eventos por Mes (${year})`, font: { size: 18 } },
                    legend: { labels: { font: { size: 12 }, color: '#333' } }
                },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Cantidad' } },
                    x: { title: { display: true, text: 'Mes' } }
                }
            }
        });
    };

    window.onload = () => {
        const years = getYears(rawData);
        const select = document.getElementById('yearSelect');
        select.innerHTML = years.map(y => `<option value="${y}">${y}</option>`).join('');
        select.value = years.at(-1) || '';
        updateChart();
    };
</script>
@endsection
