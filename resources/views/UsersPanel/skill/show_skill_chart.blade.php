<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chart Skills</title>
</head>
<body>
<div class="container-fluid">
        <div class="row justify-content-center">
    



<div>
  <canvas id="myChart" width="300px" height="100px"></canvas>

</div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

     

            <script>

            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [@foreach ($skills as $skill)
                        '{{ $skill->technology }}',
                    @endforeach],
                    datasets: [{
                        label: 'Number Of Score',
                        data: [@foreach ($skills as $skill )
                        {{ $skill->score }},
                        @endforeach],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            </script>


        </div>
        </div>
</body>
</html>