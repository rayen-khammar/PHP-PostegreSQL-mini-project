<?php
echo "<h3>PHP Configuration Debug</h3>";
echo "<b>PHP Version:</b> " . PHP_VERSION . "<br>";
echo "<b>Loaded php.ini:</b> " . php_ini_loaded_file() . "<br>";
echo "<b>Extension Directory:</b> " . ini_get('extension_dir') . "<br>";

echo "<h3>Drivers Found:</h3>";
echo "<pre>";
print_r(PDO::getAvailableDrivers());
echo "</pre>";

if (extension_loaded('pdo_pgsql')) {
    echo "<b style='color:green'>✅ pdo_pgsql is LOADED!</b>";
} else {
    echo "<b style='color:red'>❌ pdo_pgsql is NOT LOADED.</b>";
}
?>
