#!/bin/bash
# Local Database Setup Script

echo "🗄️ Setting up local MySQL database for Insurance Management System"
echo "================================================"

# MySQL commands to run
echo "Creating database and user..."

mysql -u root -p <<EOF
-- Create database
CREATE DATABASE IF NOT EXISTS insurance_v2;

-- Create user
CREATE USER IF NOT EXISTS 'insurance_user'@'localhost' IDENTIFIED BY 'password123';

-- Grant permissions
GRANT ALL PRIVILEGES ON insurance_v2.* TO 'insurance_user'@'localhost';
GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO 'insurance_user'@'localhost';

-- Flush privileges
FLUSH PRIVILEGES;

-- Show databases
SHOW DATABASES;

-- Show users
SELECT User, Host FROM mysql.user WHERE User = 'insurance_user';

EOF

echo "✅ Database setup completed!"
echo "Database: insurance_v2"
echo "Username: insurance_user"
echo "Password: password123"
echo ""
echo "Next step: Run 'php setup_local.php' to initialize the application"
