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
  <table>
    <tr>
      <th>Server</th>
      <th>Status</th>
      <th>Ping Result</th>
    </tr>
    <tr>
      <td><?php echo $ip_address; ?></td>
      <td><i class="fas fa-circle" style="color: <?php echo ($status == 'up' ? 'green' : 'red'); ?>"></i></td>
      <td><?php echo $ping_result; ?></td>
    </tr>
  </table>
  <br><br>
  <h2>Ping Results:</h2>
  <pre>
  <?php
    foreach ($output as $line) {
      echo "$line\n";
    }
  ?>
  </pre>
</body>
</html>
