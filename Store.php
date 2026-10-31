<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'POST requests only.']);
    exit;
}

$lat = filter_input(INPUT_POST, 'lat', FILTER_VALIDATE_FLOAT);
$lng = filter_input(INPUT_POST, 'lng', FILTER_VALIDATE_FLOAT);

if ($lat === false || $lat === null || $lng === false || $lng === null ||
    $lat < -90 || $lat > 90 || $lng < -180 || $lng > 180) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid latitude or longitude.']);
    exit;
}

$contents = "lat: {$lat}\nlng: {$lng}\n";
$saved = file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'location.txt', $contents, LOCK_EX);

if ($saved === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Could not write location.txt. Check the folder permissions.']);
    exit;
}

echo json_encode(['saved' => true]);