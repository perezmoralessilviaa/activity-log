<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !in_array($data['type'] ?? '', ['visit','download','submit'])) {
    http_response_code(400);
    exit(json_encode(['status'=>'error']));
}

$logLine = [
    date('Y-m-d H:i:s'),
    $_SERVER['REMOTE_ADDR'] ?? '',
    $data['type'],
    $data['phone'] ?? '',
    $data['email'] ?? '',
    $data['ua'] ?? '',
    $data['ref'] ?? ''
];

$logString = implode("\t", $logLine) . PHP_EOL;

// 存到 logs 文件夹
$logDir = 'logs';
if (!is_dir($logDir)) mkdir($logDir, 0777, true);

file_put_contents("$logDir/activity.log", $logString, FILE_APPEND | LOCK_EX);

echo json_encode(['status'=>'ok']);
