<?php

// Load configuration
$config = require_once __DIR__ . '/../config/config.development.php';

// Database connection settings
$dbHost = $config['DB_HOST'];
$dbName = $config['DB_NAME'];
$dbUser = $config['DB_USER'];
$dbPass = $config['DB_PASS'];
$dbPort = $config['DB_PORT'];

// Create a connection to MySQL (without database selection)
try {
    $pdo = new PDO("mysql:host=$dbHost;port=$dbPort", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    echo "Connected to MySQL successfully!\n";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}

// Function to execute SQL files
function executeSQLFile($pdo, $file)
{
    echo "Running: $file\n";
    $sql = file_get_contents($file);
    if ($sql === false) {
        echo "Failed to read $file\n";
        return;
    }
    try {
        $pdo->exec($sql);
        echo "Successfully executed: $file\n";
    } catch (PDOException $e) {
        echo "Error executing $file: " . $e->getMessage() . "\n";
    }
}

// Create database if not exists
executeSQLFile($pdo, __DIR__ . "/01-create-database.sql");

// Connect to the created database
$pdo->exec("USE $dbName");

// Execute all SQL files in order
executeSQLFile($pdo, __DIR__ . "/02-create-table-users.sql");
executeSQLFile($pdo, __DIR__ . "/03-create-table-notes.sql");
executeSQLFile($pdo, __DIR__ . "/04-changes-in-db.sql");

echo "Database setup completed successfully!\n";
