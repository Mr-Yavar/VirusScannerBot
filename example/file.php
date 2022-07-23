<?php

require_once __DIR__ . '/vendor/autoload.php';
// VirusTotal API key [REQUIRED]
$virusTotalAPI = '__VirusTotal+API+key__';
$file   = new \nguyenanhung\Tool\DrVirus\File($virusTotalAPI);

$result = $file->scan($_GET['url']);
$resource=$result["resource"];
header('Content-Type: image/png');
/*
 * VirusTotal Image Generator
 * https://github.com/Yanikore/VirusTotal-Image-Generator
 * Version: 1.1.0
 *
 * created by Yani
 * https://github.com/Yanikore
 */

/*
 * Configuration
 */




function HTTPPost($url, array $params) {
    $query = http_build_query($params);
    $ch    = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

// Cache time in seconds (10800 = 3hrs)
$cacheTime = 10800;

// Cache dir
$cacheDir = 'cache';

// Size
$width  = 600;
$height = 1200; // Height should only be changed if there are new antivir added to VT

/*
 * Actual code
 */

//error_reporting(0);

header('Pragma: public');
header('Cache-Control: max-age=' . $cacheTime);
header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + (int)$cacheTime));
header('Content-Type: image/png');
echo $resource;
// Perform a re-scan
//d($file->rescan($result['resource']));
//d($file->getReport($result['resource']));
