<?php

// Get CPU usage percentage
$cpu_usage = shell_exec("top -bn1 | grep 'Cpu(s)' | sed 's/.*, *\\([0-9.]*\\)%* id.*/\\1/'");
echo "CPU Usage: $cpu_usage % <br>";



// Get memory usage in bytes
$mem_usage = memory_get_usage(true);
echo "Memory Usage: $mem_usage bytes <br>";

// Get memory usage in megabytes
$mem_usage = memory_get_usage(true) / 1024 / 1024;
echo "Memory Usage: $mem_usage MB <br>";

// Get memory usage in kilobytes
$mem_usage = memory_get_usage(true) / 1024;
echo "Memory Usage: $mem_usage KB <br>";

// Get memory usage in gigabytes
$mem_usage = memory_get_usage(true) / 1024 / 1024 / 1024;
echo "Memory Usage: $mem_usage GB <br>";

// Get memory usage in terabytes
$mem_usage = memory_get_usage(true) / 1024 / 1024 / 1024 / 1024;
echo "Memory Usage: $mem_usage TB <br>";





// Get disk usage in bytes
$disk_usage = disk_total_space('/') - disk_free_space('/');
echo "Disk Usage: $disk_usage bytes <br>";

// Get disk free space in bytes
$disk_free = disk_free_space('/');
echo "Disk Free Space: $disk_free bytes <br>";

// Get disk usage in megabytes
$disk_usage = (disk_total_space('/') - disk_free_space('/')) / 1024 / 1024;
echo "Disk Usage: $disk_usage MB <br>";

// Get disk free space in megabytes
$disk_free = disk_free_space('/') / 1024 / 1024;
echo "Disk Free Space: $disk_free MB <br>";

// Get disk usage in kilobytes
$disk_usage = (disk_total_space('/') - disk_free_space('/')) / 1024;
echo "Disk Usage: $disk_usage KB <br>";

// Get disk free space in kilobytes
$disk_free = disk_free_space('/') / 1024;
echo "Disk Free Space: $disk_free KB <br>";

// Get disk usage in gigabytes
$disk_usage = (disk_total_space('/') - disk_free_space('/')) / 1024 / 1024 / 1024;
echo "Disk Usage: $disk_usage GB <br>";

// Get disk free space in gigabytes
$disk_free = disk_free_space('/') / 1024 / 1024 / 1024;
echo "Disk Free Space: $disk_free GB <br>";

// Get disk usage in terabytes
$disk_usage = (disk_total_space('/') - disk_free_space('/')) / 1024 / 1024 / 1024 / 1024;
echo "Disk Usage: $disk_usage TB <br>";

// Get disk free space in terabytes
$disk_free = disk_free_space('/') / 1024 / 1024 / 1024 / 1024;
echo "Disk Free Space: $disk_free TB <br>";










?>