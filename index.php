<!DOCTYPE html>
<html>
<head>
  <title>Network Monitoring Tool</title>
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
      $socket = @fsockopen($ip_address, 80, $errno, $errstr, 2);
      if ($socket) {
        echo "The IP address $ip_address is up (socket test).<br>";
      } else {
        echo "The IP address $ip_address is down (socket test).<br>";
      }

      $output = shell_exec("ping -n 4 $ip_address");
      echo "<pre>$output</pre>";
    }
  ?>
</body>
</html>
