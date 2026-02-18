<?php
$url = 'http://localhost/hyperleadsorbits/leads-orbit-backend/public/index.php/api/login';
$data = ['email' => 'test@example.com', 'password' => 'password'];

$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\nAccept: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
        'ignore_errors' => true
    ]
];

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo "Status: " . $http_response_header[0] . "\n";
echo "Result: " . $result . "\n";
