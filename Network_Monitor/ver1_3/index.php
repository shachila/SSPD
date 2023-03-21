<!DOCTYPE html>
<html>
<head>
  <title>Network Monitoring Tool</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 5px;
    }
  </style>
</head>
<body>
  <h2>Enter IP Address:</h2>
  <form action="index.php" method="post">
    <input type="text" name="ip_address">
    <input type="submit" value="Check">
  </form>
  <br><br>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $ip_address = $_POST["ip_address"];
      $status = @fsockopen($ip_address, 80, $errno, $errstr, 2) ? 'up' : 'down';
      $ping = exec("ping -n 1 $ip_address", $output, $result);
      $ping_result = ($result == 0) ? "successful" : "unsuccessful";
      echo "<table>";
      echo "<tr><th>Server</th><th>Status</th><th>Ping Result</th></tr>";
      echo "<tr>";
      echo "<td>$ip_address</td>";
      echo "<td><i class='fas fa-circle' style='color: ".($status == 'up' ? 'green' : 'red')."'></i></td>";
      echo "<td>$ping_result</td>";
      echo "</tr>";
      echo "</table>";
      echo "<br><br>";
      echo "<h2>Ping Results:</h2>";
      echo "<pre>";
      foreach ($output as $line) {
        echo "$line\n";
      }
      echo "</pre>";

      
    }
  ?>
</body>
</html>
