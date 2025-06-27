```blade
@extends('sstsena::layouts.master')

@section('content')
    <h1>Administrador</h1>

    <div id="chartContainer">
        <select id="yearSelect" onchange="updateChart()">
            <!-- Years will be populated dynamically -->
        </select>
        <canvas id="eventsChart"></canvas>
    </div>

    <!-- Include Chart.js and Moment.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

    <style>
        #chartContainer {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        select {
            padding: 8px;
            margin-bottom: 20px;
            font-size: 16px;
        }
    </style>

    <script>
        // Data from Laravel controller, injected via Blade
        const rawData = {
            accidents: [
                @foreach ($accidents as $accident)
                    { date_time: '{{ $accident->date_time }}' }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ],
            incidents: [
                @foreach ($incidents as $incident)
                    { date_time: '{{ $incident->date_time }}' }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ],
            emergencies: [
                @foreach ($emergencies as $emergency)
                    { date_time: '{{ $emergency->date_time }}' }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ]
        };

        // Process data by month and year
        function processDataByMonthYear(data, year) {
            const months = moment.monthsShort();
            const accidentsByMonth = new Array(12).fill(0);
            const incidentsByMonth = new Array(12).fill(0);
            const emergenciesByMonth = new Array(12).fill(0);

            // Count accidents
            data.accidents.forEach(item => {
                if (item.date_time) {
                    const date = moment(item.date_time);
                    if (date.isValid() && date.year() === parseInt(year)) {
                        accidentsByMonth[date.month()]++;
                    }
                }
            });

            // Count incidents
            data.incidents.forEach(item => {
                if (item.date_time) {
                    const date = moment(item.date_time);
                    if (date.isValid() && date.year() === parseInt(year)) {
                        incidentsByMonth[date.month()]++;
                    }
                }
            });

            // Count emergencies
            data.emergencies.forEach(item => {
                if (item.date_time) {
                    const date = moment(item.date_time);
                    if (date.isValid() && date.year() === parseInt(year)) {
                        emergenciesByMonth[date.month()]++;
                    }
                }
            });

            return { months, accidentsByMonth, incidentsByMonth, emergenciesByMonth };
        }

        // Get unique years from all data
        function getUniqueYears(data) {
            const years = new Set();
            ['accidents', 'incidents', 'emergencies'].forEach(type => {
                data[type].forEach(item => {
                    if (item.date_time) {
                        const year = moment(item.date_time).year();
                        if (year) years.add(year);
                    }
                });
            });
            return Array.from(years).sort();
        }

        // Initialize chart
        let chart;
        function initializeChart() {
            const years = getUniqueYears(rawData);
            const yearSelect = document.getElementById('yearSelect');

            // Populate year dropdown
            if (years.length === 0) {
                yearSelect.innerHTML = '<option value="">No data available</option>';
                return;
            }

            years.forEach(year => {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                yearSelect.appendChild(option);
            });

            // Default to the latest year
            yearSelect.value = years[years.length - 1];
            updateChart();
        }

        // Update chart based on selected year
        function updateChart() {
            const selectedYear = document.getElementById('yearSelect').value;
            if (!selectedYear) return;

            const { months, accidentsByMonth, incidentsByMonth, emergenciesByMonth } = processDataByMonthYear(rawData, selectedYear);

            if (chart) chart.destroy();

            chart = new Chart(document.getElementById('eventsChart'), {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Accidents',
                            data: accidentsByMonth,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Incidents',
                            data: incidentsByMonth,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Emergencies',
                            data: emergenciesByMonth,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: `Events by Month (${selectedYear})`
                        }
                    }
                }
            });
        }

        // Initialize on page load
        window.onload = initializeChart;
    </script>
@endsection
```