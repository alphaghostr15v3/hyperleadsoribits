<?php
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[$name] = trim($value, '"');
    }
}

echo "DB_DATABASE: " . ($_ENV['DB_DATABASE'] ?? 'Not set') . "<br>";
echo "DB_USERNAME: " . ($_ENV['DB_USERNAME'] ?? 'Not set') . "<br>";
echo "DB_HOST: " . ($_ENV['DB_HOST'] ?? 'Not set') . "<br>";

try {
    $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'] . ";port=" . ($_ENV['DB_PORT'] ?? 3306);
    $pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'] ?? '');
    echo "<h1>Connected successfully to database!</h1>";
} catch (PDOException $e) {
    echo "<h1>Connection failed: " . $e->getMessage() . "</h1>";
}
