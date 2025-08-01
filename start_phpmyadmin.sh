#!/bin/bash

# phpMyAdmin Local Server Starter for Insurance Management System
echo "🗄️ Starting phpMyAdmin for Insurance Management System"
echo "================================================"
echo "📋 Database: insurance_v2"
echo "👤 User: insurance_user" 
echo "🌐 URL: http://localhost:8080/phpmyadmin"
echo "================================================"

# Check if MySQL is running
if ! brew services list | grep mysql | grep started > /dev/null; then
    echo "⚠️ MySQL is not running. Starting MySQL..."
    brew services start mysql
    sleep 3
fi

# Create temporary directory structure
TEMP_DIR="/tmp/phpmyadmin_insurance"
mkdir -p "$TEMP_DIR"

# Copy phpMyAdmin files
cp -r /opt/homebrew/share/phpmyadmin/* "$TEMP_DIR/"

# Copy our custom config
cp "$(dirname "$0")/phpmyadmin_config.inc.php" "$TEMP_DIR/config.inc.php"

echo "🚀 Starting phpMyAdmin server on http://localhost:8080"
echo "🔄 Press Ctrl+C to stop"
echo ""

# Start PHP server
cd "$TEMP_DIR"
php -S localhost:8080
