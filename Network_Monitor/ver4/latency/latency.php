<?php
$ipaddress = "192.168.0.1"; // replace with the IP address you want to generate a report for
$count = 10; // number of times to ping each hop
$timeout = 1000; // timeout in milliseconds
$hopcount = 20; // maximum number of hops to include in the report

$output = shell_exec("pathping -n -q $count -w $timeout -h $hopcount $ipaddress");
echo $output;
?>


<?php
$ipaddress = "8.8.8.8"; // replace with the IP address you want to generate a report for
$count = 10; // number of times to ping each hop
$timeout = 1000; // timeout in milliseconds
$hopcount = 20; // maximum number of hops to include in the report

$output = shell_exec("pathping -n -q $count -w $timeout -h $hopcount $ipaddress");
echo "<pre>";
echo "Latency report for $ipaddress:\n";
echo str_repeat("-", 80) . "\n\n";
echo "Hop\tIP Address\t\tSent\tReceived\tLoss %\tMinimum\tAverage\tMaximum\n";
echo str_repeat("-", 80) . "\n";

$start = strpos($output, "Hop") + strlen("Hop");
$end = strpos($output, "Target") - 1;
$data = substr($output, $start, $end - $start);
$lines = explode("\n", $data);
foreach ($lines as $line) {
    $cols = preg_split("/\s+/", $line);
    if (count($cols) >= 8) {
        $hop = $cols[0];
        $ip = $cols[1];
        $sent = $cols[2];
        $recv = $cols[3];
        $loss = $cols[4];
        $min = $cols[5];
        $avg = $cols[6];
        $max = $cols[7];
        echo "$hop\t$ip\t$sent\t$recv\t$loss\t$min\t$avg\t$max\n";
    }
}

echo str_repeat("-", 80) . "\n\n";
echo "Full report:\n\n";
echo $output;
echo "</pre>";
?>


<?php
$ipaddress = "8.8.8.8"; // replace with the IP address you want to generate a report for
$count = 10; // number of times to ping each hop
$timeout = 1000; // timeout in milliseconds
$hopcount = 20; // maximum number of hops to include in the report
$threshold = 1; // threshold value in milliseconds
$to = "shachilathanuth@gmail.com"; // replace with the email address to send the notification to
$from = "shachilathanuth@yahoo.com"; // replace with the email address to send the notification from
$subject = "Network latency threshold exceeded";

$output = shell_exec("pathping -n -q $count -w $timeout -h $hopcount $ipaddress");
echo "<pre id='report'>";
echo "Latency report for $ipaddress:\n";
echo str_repeat("-", 80) . "\n\n";
echo "Hop\tIP Address\t\tSent\tReceived\tLoss %\tMinimum\tAverage\tMaximum\n";
echo str_repeat("-", 80) . "\n";

$start = strpos($output, "Hop") + strlen("Hop");
$end = strpos($output, "Target") - 1;
$data = substr($output, $start, $end - $start);
$lines = explode("\n", $data);
foreach ($lines as $line) {
    $cols = preg_split("/\s+/", $line);
    if (count($cols) >= 8) {
        $hop = $cols[0];
        $ip = $cols[1];
        $sent = $cols[2];
        $recv = $cols[3];
        $loss = $cols[4];
        $min = $cols[5];
        $avg = $cols[6];
        $max = $cols[7];
        echo "$hop\t$ip\t$sent\t$recv\t$loss\t$min\t$avg\t$max\n";
    }
}

echo str_repeat("-", 80) . "\n\n";
echo "Full report:\n\n";
echo $output;
echo "</pre>";
?>

<script>
setInterval(function() {
    document.getElementById("report").innerHTML = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("report").innerHTML = this.responseText;
            checkThreshold(this.responseText);
        }
    };
    xhttp.open("GET", "latency.php", true);
    xhttp.send();
}, 30000); // refresh every 30 seconds

function checkThreshold(report) {
    var lines = report.split("\n");
    var lastLine = lines[lines.length - 2];
    var cols = lastLine.split("\t");
    var avg = parseInt(cols[6]);
    if (avg > <?php echo $threshold; ?>) {
        sendEmail();
    }
}

function sendEmail() {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "send_email.php", true);
    xhttp.send();
}
</script>
