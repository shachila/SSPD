<!DOCTYPE html>
<html>
<head>
  <title>Network Monitoring Tool</title>
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
      padding: 5px;
      text-align: center;
    }
    .up {
      background-color: green;
    }
    .down {
      background-color: red;
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
      $ping = exec("ping -n 1 $ip_address", $output, $status);
      $socket = @fsockopen($ip_address, 80, $errno, $errstr, 2);
      if ($socket) {
        $socket_status = "up";
        fclose($socket);
      } else {
        $socket_status = "down";
      }
  ?>
  <table style="width:50%">
    <tr>
      <th>Check</th>
      <th>Result</th>
      <th>Graphical Representation</th>
    </tr>
    <tr>
      <td>Ping</td>
      <td><?php echo $status == 0 ? "up" : "down"; ?></td>
      <td class="<?php echo $status == 0 ? "up" : "down"; ?>"></td>
    </tr>
    <tr>
      <td>Socket Connection</td>
      <td><?php echo $socket_status; ?></td>
      <td class="<?php echo $socket_status; ?>"></td>
    </tr>
  </table>
  <?php
    }
  ?>
</body>
</html>
