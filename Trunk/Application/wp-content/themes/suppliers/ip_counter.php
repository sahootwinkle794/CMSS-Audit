<?php
function get_unique_visits() {
    $ip = $_SERVER['REMOTE_ADDR'];  // Visitor IP
    $file = 'visit.txt';            // File to store IPs
    $start_count = 328573;          // Starting visitor count

    // Create the file if it doesn't exist
    if (!file_exists($file)) {
        file_put_contents($file, '');
    }

    // Read all stored IPs
    $ips = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // If this IP is new, append it to the file
    if (!in_array($ip, $ips)) {
        $fp = fopen($file, 'a');
        if (flock($fp, LOCK_EX)) {          // Lock file to prevent race conditions
            fwrite($fp, $ip . PHP_EOL);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
        $ips[] = $ip;  // Add to array for counting
    }

    // Return starting count + number of new unique IPs
    return $start_count + count($ips);
}
?>
