<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip_address = $_POST["ip_address"];
    $status = @fsockopen($ip_address, 80, $errno, $errstr, 2) ? 'up' : 'down';
    $ping = exec("ping -n 4 $ip_address", $output, $result);
    $ping_result = ($result == 0) ? "successful" : "unsuccessful";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "network_monitor";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO monitoring (ip_address, status, ping_result)
    VALUES ('$ip_address', '$status', '$ping_result')";
    if ($conn->query($sql) === TRUE) {
      echo "Record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Network Monitoring Tool</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 5px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <i class="fas fa-tachometer-alt"></i> Home
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Settings</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3">
        <nav id="sidebar">
          <div class="sidebar-header">
            <h3>Network Monitoring</h3>
            <strong>NM</strong>
          </div>
          <ul class="list-unstyled components">
            <li class="active">
              <a href="#">
                <i class="fas fa-tachometer-alt"></i> Dashboard
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fas fa-sign-in-alt"></i> Login
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fas fa-cog"></i> Settings
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fas fa-chart-bar"></i> Reports
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="col-sm-9">
        <h3>Enter IP Address</h3>
        <form method="post">
          <div class="form-group">
            <label for="ip_address">IP Address:</label>
            <input type="text" class="form-control" id="ip_address" name="ip_address" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <?php
          if (isset($status)) {
        ?>
        <h3>Server Status</h3>
        <table style="width:50%">
          <tr>
            <th>IP Address</th>
            <th>Status</th>
            <th>Indicator</th>
            <th>Ping Result</th>
          </tr>
          <tr>
            <td><?php echo $ip_address; ?></td>
            <td><?php echo $status; ?></td>
            <td>
              <?php if ($status == 'up') { ?>
                <i class="fas fa-check-circle text-success"></i>
              <?php } else { ?>
                <i class="fas fa-times-circle text-danger"></i>
              <?php } ?>
            </td>
            <td><?php echo $ping_result; ?>
            </td>
          </tr>
        </table>
        <br>
            <h2>Ping Results:</h2>
            <pre>
                <?php
                foreach ($output as $line) {
                echo "$line\n";
                }
                ?>
            </pre>
          <?php
            }
          ?>

        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
  </html>
  