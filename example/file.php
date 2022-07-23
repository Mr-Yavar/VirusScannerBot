<?php

require_once __DIR__ . '/vendor/autoload.php';
$apiKey = '1a7361cbc73a0d6ec36708504b1772037f50fdc36bbabcae455bc6ab8d0caec4';
$file   = new \nguyenanhung\Tool\DrVirus\File($apiKey);

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

// VirusTotal API key [REQUIRED]
$virusTotalAPI = '1a7361cbc73a0d6ec36708504b1772037f50fdc36bbabcae455bc6ab8d0caec4';

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
