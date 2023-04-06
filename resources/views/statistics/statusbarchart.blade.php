<div class="container col-10 col-md-7">
    <canvas id="statusbarChart" class="elevation-5 bg-dark"></canvas>
</div>

<!--scripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var barctx = document.getElementById('statusbarChart').getContext('2d');

    var barchart = new Chart(barctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Number Of Orders',
                data: [],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'x',
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                x: {
                    grid: {
                        offset: true
                    }
                }
            }
        }
    });

    $.ajax({
                url: '{{ route('statusbarchart.data') }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    barchart.data.labels = data.labels;
                    barchart.data.datasets[0].data = data.data;
                    barchart.update();
                }
            });

</script>
