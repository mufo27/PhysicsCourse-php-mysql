<?php


define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'physics');
define('DB_CHARSET', 'utf8');
define('TIMEZONE', 'Asia/Bangkok');

try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";charset=" . DB_CHARSET,
        DB_USERNAME,
        DB_PASSWORD,
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );

    date_default_timezone_set(TIMEZONE);

    $successMessage = "Connected to the database successfully";
    error_log($successMessage, 0);

} catch (PDOException $e) {

    $errorMessage = "Connection failed: " . $e->getMessage();
    error_log($errorMessage, 0);

    echo "Unable to connect to the database. Please try again later.";
}
