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
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <title>Network Monitoring</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <i class="fas fa-tachometer-alt"></i>
        Home
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-sign-in-alt"></i>
              Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-cog"></i>
              Settings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-file-alt"></i>
              Reports
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container my-5">
      <div class="row">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>IP Address</th>
              <th>Status</th>
              <th>Ping Result</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $conn = mysqli_connect("localhost", "root", "", "network_monitor");
              $sql = "SELECT * FROM monitoring";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)) {
                $ip_address = $row['ip_address'];
                $ping = exec("ping -n 1 $ip_address", $output, $status);
                if ($status == 0) {
                  $status_icon = '<i class="fas fa-check-circle text-success"></i>';
                  $status_text = 'Server is up';
                } else {
                  $status_icon = '<i class="fas fa-times-circle text-danger"></i>';
                  $status_text = 'Server is down';
                }
                echo '<tr>
                        <td>'.$ip_address.'</td>
                        <td>'.$status_icon.' '.$status_text.'</td>
                        <td>'.$ping.'</td>
                        <td>
                          <a href="delete.php?ip_address='.$ip_address.'" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="row my-5">
        <div class="col-6 offset-3">
          <form action="save.php" method="post">
            <div class="form-group">
              <label for="ip_address">Enter IP Address:</label>
              <input type="text" class="form-control" id="ip_address" name="ip_address" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Check</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  </body>
</html>


