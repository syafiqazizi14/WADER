<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::with('roles')->first();

echo "=== User Info ===\n";
echo "User: " . ($user ? $user->name . " (" . $user->email . ")" : "No users found") . "\n";

if ($user) {
    echo "Roles: ";
    $roles = $user->roles->pluck('name')->toArray();
    echo implode(', ', $roles) ?? "No roles";
    echo "\n";
    echo "Has superadmin role: " . ($user->hasRole('superadmin') ? 'YES' : 'NO') . "\n";
    echo "Has editor role: " . ($user->hasRole('editor') ? 'YES' : 'NO') . "\n";
}

echo "\n=== All Roles ===\n";
$allRoles = \App\Models\Role::all();
foreach ($allRoles as $role) {
    echo "- {$role->name}\n";
}
