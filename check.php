<?php
header('Content-Type: application/json');

$api_url = "https://topupku.com/api/game";
$api_id = ""; // api_id topupku
$api_key = ""; //api_key topupku

$user_id = $_POST['user_id'] ?? '';
$zone_id = $_POST['zone_id'] ?? '';
$code = $_POST['code'] ?? '';

if (empty($user_id) || empty($code)) {
    echo json_encode(["status" => false, "message" => "User ID dan Code wajib diisi"]);
    exit;
}
$signature = md5($api_id . $api_key); //sign

$post_data = [
    "api_id" => $api_id,
    "api_key" => $api_key,
    "signature" => $signature,
    "user_id" => $user_id,
    "zone_id" => $zone_id,
    "code" => $code
];

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($post_data))
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(["status" => false, "message" => "cURL Error: " . curl_error($ch)]);
    curl_close($ch);
    exit;
}
curl_close($ch);


echo $response;
