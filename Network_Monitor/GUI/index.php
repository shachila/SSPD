<!DOCTYPE html>
<html>
<head>
  <title>Network Monitor Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Chart.js CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.css">
</head>
<body>
  <!-- Navigation bar -->
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Network Monitor</a>
      </div>
    </div>
  </nav>
  
  <div class="container">
    <!-- Sidebar -->
    <div class="col-md-3">
      <h3>Dashboard</h3>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#">Latency</a></li>
        <li><a href="#">Bandwidth</a></li>
        <li><a href="#">Packet Loss</a></li>
      </ul>
    </div>
    
    <!-- Main content -->
    <div class="col-md-9">
      <h1>Latency</h1>
      <canvas id="latency-chart"></canvas>
    </div>
  </div>
  
  <!-- jQuery and Bootstrap JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Chart.js JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
  <script>
    // Get data from backend server (replace with your own API endpoint)
    $.get('/api/latency', function(data) {
      var ctx = document.getElementById('latency-chart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: data.labels,
          datasets: [{
            label: 'Latency (ms)',
            data: data.values,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
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
});
</script>
</body>
</html>
