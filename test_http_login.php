<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

$client = new Client([
    'base_uri' => 'http://localhost:8000',
    'allow_redirects' => false,  // Don't auto-follow redirects
    'cookies' => true,  // Handle cookies
]);

echo "=== Test HTTP Login Flow ===\n\n";

// Step 1: Get login page to extract CSRF token
echo "1. Getting login page...\n";
try {
    $response = $client->get('/login');
    $html = (string)$response->getBody();
    
    // Try to find the CSRF token - look for @csrf pattern in Blade templates  
    if (preg_match('/<input[^>]*name="csrf_token"[^>]*value="([^"]+)"/', $html, $matches)) {
        $csrfToken = $matches[1];
        echo "   CSRF token found: " . substr($csrfToken, 0, 10) . "...\n";
    } else {
        echo "   WARNING: Could not find CSRF token in HTML!\n";
        // Try alternative pattern
        if (preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $html, $matches)) {
            $csrfToken = $matches[1];
            echo "   Found _token field instead: " . substr($csrfToken, 0, 10) . "...\n";
        } else {
            echo "   ERROR: No token found!\n";
            exit(1);
        }
    }
} catch (\Exception $e) {
    echo "   ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

// Step 2: Submit login form
echo "\n2. Submitting login form...\n";
try {
    $response = $client->post('/login', [
        'form_params' => [
            '_token' => $csrfToken,
            'email' => 'admin@wader.local',
            'password' => 'password123',
        ]
    ]);
    
    $status = $response->getStatusCode();
    echo "   Response status: $status\n";
    
    if ($response->hasHeader('Location')) {
        $location = $response->getHeader('Location')[0];
        echo "   Redirect location: $location\n";
    }
} catch (\Exception $e) {
    echo "   ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

// Step 3: Try to access dashboard
echo "\n3. Trying to access dashboard...\n";
try {
    $response = $client->get('/dashboard');
    $status = $response->getStatusCode();
    echo "   Response status: $status\n";
    
    if ($response->hasHeader('Location')) {
        $location = $response->getHeader('Location')[0];
        echo "   Redirect location: $location\n";
    }
    
    $body = (string)$response->getBody();
    if (strpos($body, 'RouteNotFoundException') !== false) {
        echo "   ERROR: RouteNotFoundException found in response!\n";
    } else {
        echo "   OK: No error found\n";
    }
} catch (\GuzzleHttp\Exception\ClientException $e) {
    $response = $e->getResponse();
    $status = $response->getStatusCode();
    $body = (string)$response->getBody();
    
    echo "   Error status: $status\n";
    
    if ($status === 404) {
        echo "   ERROR: 404 - Route not found!\n";
    } elseif ($status === 403) {
        echo "   ERROR: 403 - Forbidden (permission denied)\n";
    } else {
        echo "   Response body (first 500 chars):\n";
        echo "   " . substr($body, 0, 500) . "\n";
    }
} catch (\Exception $e) {
    echo "   ERROR: " . $e->getMessage() . "\n";
}

echo "\nTest complete.\n";
