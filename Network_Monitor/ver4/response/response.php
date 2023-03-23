<?php
$ipaddress = "8.8.8.8"; // replace with the IP address of the Windows PC or server
$count = 3; // number of times to ping the IP address
$timeout = 1000; // timeout in milliseconds

$output = shell_exec("ping -n " . $count . " -w " . $timeout . " " . $ipaddress);
if (strpos($output, "Average =") !== false) {
    $start = strpos($output, "Average =") + strlen("Average =");
    $end = strpos($output, "ms", $start);
    $time = substr($output, $start, $end - $start);
    echo "Response time: " . $time . " ms";
} else {
    echo "Could not connect to the IP address.";
}
?>
