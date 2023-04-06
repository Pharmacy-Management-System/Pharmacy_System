<div class="container col-10 col-md-4">
    <canvas id="statuspieChart" class="elevation-5 bg-dark"></canvas>
</div>

<!--scripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var piectx = document.getElementById('statuspieChart').getContext('2d');

    var piechart = new Chart(piectx, {
        type: 'pie',
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
            indexAxis: 'y',
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
                url: '{{ route('statuspiechart.data') }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    piechart.data.labels = data.labels;
                    piechart.data.datasets[0].data = data.data;
                    piechart.update();
                }
            });

</script>
