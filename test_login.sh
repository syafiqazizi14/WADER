#!/bin/bash
# Get login page for CSRF token
RESPONSE=$(curl -s -c cookies.txt "http://localhost:8000/login")

# Extract CSRF token from the form (looking for the value that has a specific pattern)
CSRF=$(echo "$RESPONSE" | grep -oP '(?<=name="csrf_token" value=")[^"]*' || echo "NOT_FOUND")

echo "CSRF Token: $CSRF"

# Try to login with the credentials
RESULT=$(curl -s -b cookies.txt -c cookies.txt -X POST "http://localhost:8000/login" \
  -d "email=admin@wader.local&password=password123" \
  -H "X-Requested-With: XMLHttpRequest" \
  --write-out "%{http_code}")

echo "Login response: $RESULT"
