<?php

use Oid;

// Set up SNMP connection to Windows server
$ip_address = "192.168.1.10";
$community_string = "public";
$snmp = new SNMP(SNMP::VERSION_2c, $ip_address, $community_string);

// Get CPU usage data
$cpu_oid = new Oid("1.3.6.1.2.1.25.3.3.1.2.1"); // OID for CPU usage
$cpu_data = $snmp->get($cpu_oid); // Get CPU usage data

// Display CPU usage data
echo "CPU usage: " . $cpu_data . "%";

?>