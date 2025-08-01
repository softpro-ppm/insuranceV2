# 🚀 Insurance Management System v2.0 - Local Development

## Quick Start Guide

### Prerequisites
- PHP 7.4+ installed
- MySQL installed and running
- Git (for version control)

### Installation Steps

#### 1. Setup Database
```bash
# Run the database setup script
./setup_database.sh

# Or manually in MySQL:
mysql -u root -p
CREATE DATABASE insurance_v2;
CREATE USER 'insurance_user'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON insurance_v2.* TO 'insurance_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 2. Initialize Application
```bash
# Initialize database tables and sample data
php setup_local.php
```

#### 3. Start Development Server
```bash
# Start local server
php server.php
```

#### 4. Access Application
- **URL**: http://localhost:8000
- **Admin Login**: admin / admin123

### 📋 Features Available
- ✅ Dashboard with real-time statistics
- ✅ Customer Management (CRUD)
- ✅ Policy Management (CRUD)
- ✅ Agent Management (CRUD)
- ✅ Data Tables with search, sort, pagination
- ✅ Bootstrap UI with responsive design

### 🔧 Development Notes

#### Local Database Config
- **Host**: localhost
- **Database**: insurance_v2
- **Username**: insurance_user
- **Password**: password123

#### File Structure
```
/config/database_local.php   - Local DB config
/server.php                  - Development server
/setup_local.php            - Local setup script
/setup_database.sh          - Database creation script
```

#### Useful Commands
```bash
# Reset and reload data
php setup_local.php

# Start server on different port
php -S localhost:8080 -t . index.php

# Check database connection
php -r "require 'config/app.php'; require 'app/Database.php'; echo 'Connected: ' . (Database::getInstance() ? 'YES' : 'NO');"
```

### 🚀 After Local Testing

Once everything works locally:
1. Test all features thoroughly
2. Fix any issues in local environment
3. Create deployment package for Hostinger
4. Deploy to production

### 🆘 Troubleshooting

#### Database Connection Issues
- Ensure MySQL is running: `brew services start mysql` (macOS)
- Check credentials in `/config/database_local.php`
- Verify database exists: `mysql -u insurance_user -p insurance_v2`

#### Port Already in Use
- Kill existing server: `lsof -ti:8000 | xargs kill`
- Use different port: `php -S localhost:8001 -t . index.php`

#### Permission Issues
- Make scripts executable: `chmod +x setup_database.sh`
- Check file permissions: `ls -la`
