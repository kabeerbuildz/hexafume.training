<?php
/**
 * Quick script to bypass installer setup
 * Run this file directly: php bypass_setup.php
 * Or access via browser: http://yoursite.com/bypass_setup.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    // Get database connection
    $pdo = new PDO(
        "mysql:host=" . env('DB_HOST', '127.0.0.1') . ";dbname=" . env('DB_DATABASE', 'forge'),
        env('DB_USERNAME', 'forge'),
        env('DB_PASSWORD', '')
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update setup_complete to 1
    $stmt = $pdo->prepare("UPDATE configurations SET value = '1' WHERE config = 'setup_complete'");
    $stmt->execute();
    
    $affected = $stmt->rowCount();
    
    // If no row was updated, insert a new one
    if ($affected == 0) {
        $stmt = $pdo->prepare("INSERT INTO configurations (config, value, created_at, updated_at) VALUES ('setup_complete', '1', NOW(), NOW())");
        $stmt->execute();
        echo "✓ Setup complete status created and set to 1\n";
    } else {
        echo "✓ Setup complete status updated to 1\n";
    }
    
    // Clear cache
    if (function_exists('opcache_reset')) {
        opcache_reset();
    }
    
    echo "✓ Installer bypass completed successfully!\n";
    echo "You can now access your website normally.\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Please check your database credentials in .env file\n";
}

