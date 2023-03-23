<?php

//input the server name or IP address
$server = $_POST['ip'];

// This script will ping a server and return the result
//$server1 = "google.com";
$pingresult = exec("ping -n 3 " . $server, $outcome, $status);


echo "Ping result: " . $pingresult ."<BR>".  "Status: " . $status . "<BR>";

if (0 == $status) {
    echo "Server is up and running!";
} else {
    echo "Server is down!";
}
?>