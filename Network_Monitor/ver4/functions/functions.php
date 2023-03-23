<?php

// Path: ver4\functions\functions.php
// Compare this snippet from ver4\uptime\uptime.php:

function getServerUptime() {
    $uptime = shell_exec("uptime");
    return trim($uptime);
}

getServerUptime();

// Compare this snippet from ver4\traffic\traffic.php:
function getNetworkTraffic() {
    $output = shell_exec("netstat -e");
    $lines = explode("\n", $output);
    $cols = preg_split("/\s+/", $lines[3]);
    $stats = array(
        "bytes_received" => $cols[0],
        "bytes_sent" => $cols[3],
        "packets_received" => $cols[1],
        "packets_sent" => $cols[4],
        "errors_received" => $cols[2],
        "errors_sent" => $cols[5],
    );
    return $stats;
}

// Compare this snippet from ver4\response\response.php:
function getResponseTime($host) {
    $output = shell_exec("ping -n 1 $host");
    $start = strpos($output, "time=") + strlen("time=");
    $end = strpos($output, "ms");
    $time = substr($output, $start, $end - $start);
    return $time;
}






function getServerLoad() {
    $load = shell_exec("uptime");
    $load = explode("load average:", $load);
    $load = explode(",", $load[1]);
    return trim($load[0]);
}

getServerLoad();

function getServerMemory() {
    $memory = shell_exec("free -m");
    $memory = explode("Mem:", $memory);
    $memory = explode(" ", $memory[1]);
    $memory = array_filter($memory);
    $memory = array_merge($memory);
    return trim($memory[1]);
}

function getServerMemoryUsage() {
    $memory = shell_exec("free -m");
    $memory = explode("Mem:", $memory);
    $memory = explode(" ", $memory[1]);
    $memory = array_filter($memory);
    $memory = array_merge($memory);
    $used = $memory[1] - $memory[3];
    $usage = round($used / $memory[1] * 100);
    return $usage;
}




?>
