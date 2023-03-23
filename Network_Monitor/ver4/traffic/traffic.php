<?php
$ipaddress = "8.8.8.8"; // replace with the IP address of the Windows PC or server
$command = "netstat -e -p tcp"; // command to get network statistics

$output = shell_exec("ping -n 3 " . $ipaddress);
if (strpos($output, "Reply from") !== false) {
    $traffic = shell_exec($command);
    echo "<pre>$traffic</pre>";
} else {
    echo "Could not connect to the IP address.";
}
?>
