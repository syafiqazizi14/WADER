<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;

$user = User::where('email', 'admin@wader.local')->first();

echo "=== Login Test ===\n";
echo "User found: " . ($user ? "YES" : "NO") . "\n";

if ($user) {
    echo "User email: " . $user->email . "\n";
    echo "User password hash exists: YES\n";
    
    // Try to authenticate
    $authenticate = Auth::attempt([
        'email' => 'admin@wader.local',
        'password' => 'password123',
    ]);
    
    echo "Authentication attempt: " . ($authenticate ? "SUCCESS" : "FAILED") . "\n";
    
    if ($authenticate) {
        echo "Authenticated user: " . Auth::user()->name . "\n";
        echo "User roles: " . implode(",", $user->roles->pluck('name')->toArray()) . "\n";
    }
}
