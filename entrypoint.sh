#!/bin/bash

set -e

# Run composer install if vendor directory doesn't exist
if [ ! -d "vendor" ]; then
  echo "Installing dependencies..."
  composer install
fi

# Optional: run any setup or CLI commands here
echo "Running Code Checks and Tests..."
composer check-code

echo "Running a basic console command to show cart summary..."
bin/console app:calculate

# Start a shell by default
exec "$@"