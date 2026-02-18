<?php
echo "<h1>Hostinger Diagnostic Tool</h1>";

echo "<h2>Server Environment</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Current User: " . get_current_user() . "<br>";
echo "Script Path: " . __FILE__ . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

echo "<h2>Directory Permissions</h2>";
$directories = ['../', './', '../storage', '../bootstrap/cache'];
foreach ($directories as $dir) {
    if (file_exists($dir)) {
        $perms = substr(sprintf('%o', fileperms($dir)), -3);
        echo "{$dir}: <strong>{$perms}</strong> " . (is_writable($dir) ? "(Writable)" : "(NOT Writable)") . "<br>";
    } else {
        echo "{$dir}: does not exist<br>";
    }
}

echo "<h2>.htaccess Check</h2>";
foreach (['.htaccess', '../.htaccess', 'public/.htaccess'] as $file) {
    if (file_exists($file)) {
        echo "<h3>Content of {$file}:</h3>";
        echo "<pre>" . htmlspecialchars(file_get_contents($file)) . "</pre>";
    } else {
        echo "{$file} does not exist.<br>";
    }
}

echo "<h2>Directory Listing</h2>";
echo "<pre>";
foreach (scandir('./') as $item) {
    echo $item . (is_dir($item) ? '/' : '') . "\n";
}
echo "</pre>";
