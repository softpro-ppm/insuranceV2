# Insurance Management System v2.0 - Deployment Checklist

## ✅ Pre-Deployment Checklist

### 📋 System Requirements Verification
- [ ] PHP 7.4+ installed and configured
- [ ] MySQL 5.7+ database server available
- [ ] Web server (Apache/Nginx) or PHP built-in server ready
- [ ] Required PHP extensions: PDO, PDO_MySQL, session, json

### 🗃️ Database Setup
- [ ] MySQL database created (`u820431346_v2insurance` or your custom name)
- [ ] Database user with appropriate permissions created
- [ ] Database configuration updated in `config/database.php`
- [ ] Database schema initialized using `database/init_database.sql`
- [ ] Test database connection using `test_setup.php`

### 🔧 File Configuration
- [ ] Environment file (`.env`) configured with correct database credentials
- [ ] Application configuration (`config/app.php`) reviewed
- [ ] File permissions set correctly (755 for directories, 644 for files)
- [ ] `.htaccess` file present in public directory

### 🔒 Security Setup
- [ ] Default admin password changed from "password"
- [ ] Database credentials secured (not default values)
- [ ] Error reporting disabled in production
- [ ] SSL certificate installed (for production)

## 🚀 Deployment Steps

### For Hostinger Cloud Startup Plan:

#### Step 1: File Upload
```bash
# Upload via File Manager or FTP:
- Upload all project files to your hosting account
- Ensure public/ directory is set as document root
- Verify .htaccess is uploaded and readable
```

#### Step 2: Database Setup
```sql
-- In Hostinger MySQL panel:
1. Create new database: u820431346_v2insurance
2. Create database user with full permissions
3. Import database/init_database.sql
4. Update config/database.php with Hostinger DB details
```

#### Step 3: Domain Configuration
```
- Point domain to public/ directory
- Enable SSL in Hostinger control panel
- Test URL rewriting works
```

### For Local Development:

#### Quick Start
```bash
# 1. Clone/download project
cd /path/to/insuranceV2

# 2. Setup database
mysql -u root -p
CREATE DATABASE u820431346_v2insurance;
mysql -u root -p u820431346_v2insurance < database/init_database.sql

# 3. Configure database
# Edit config/database.php with your local settings

# 4. Test setup
php test_setup.php

# 5. Start server
php -S localhost:8000 -t public

# 6. Access application
# Open http://localhost:8000
# Login: admin / password
```

## 🧪 Testing Checklist

### Basic Functionality Tests
- [ ] Login page loads correctly
- [ ] Admin login works (admin/password)
- [ ] Dashboard displays without errors
- [ ] Navigation menu works
- [ ] Logout functionality works

### Core Feature Tests
- [ ] Policy creation form loads
- [ ] Customer dropdown populates from database
- [ ] Insurance type selection works (Motor/Health/Life)
- [ ] Category-specific fields show/hide correctly
- [ ] Policy form submission creates database record
- [ ] Policies list page displays data
- [ ] Renewals page loads

### Database Tests
- [ ] All tables created successfully
- [ ] Demo data inserted correctly
- [ ] Database queries execute without errors
- [ ] API endpoints return JSON data

### UI/UX Tests
- [ ] Responsive design works on mobile
- [ ] Bootstrap styling loads correctly
- [ ] Icons display properly
- [ ] Form validation works
- [ ] Success/error messages appear

## 🔧 Production Configuration

### Environment Settings (.env)
```ini
APP_NAME="Insurance Management System v2.0"
APP_ENV=production
APP_DEBUG=false

# Database (update with your production values)
DB_HOST=your_db_host
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password
DB_DATABASE=u820431346_v2insurance

# Security
SESSION_SECURE=true
SESSION_HTTPONLY=true
```

### Apache Configuration (.htaccess)
```apache
# Already included in public/.htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
```

## 📊 Performance Optimization

### Database Optimization
- [ ] Database indexes are properly set
- [ ] Query optimization for large datasets
- [ ] Regular database maintenance scheduled

### Caching
- [ ] Browser caching enabled via .htaccess
- [ ] Static assets properly cached
- [ ] Database query results cached where appropriate

### File Optimization
- [ ] CSS/JS files minified for production
- [ ] Images optimized
- [ ] Unnecessary files removed

## 📈 Monitoring & Maintenance

### Regular Tasks
- [ ] Monitor error logs
- [ ] Database backup schedule
- [ ] Security updates applied
- [ ] Performance monitoring

### User Management
- [ ] Change default admin credentials
- [ ] Create additional user accounts as needed
- [ ] Set up user permissions properly

## 🆘 Troubleshooting Guide

### Common Issues:

**Database Connection Failed:**
```php
// Check config/database.php
// Verify MySQL service is running
// Test with: php test_setup.php
```

**404 Errors:**
```apache
# Ensure .htaccess exists in public/
# Check mod_rewrite is enabled
# Verify domain points to public/ directory
```

**PHP Errors:**
```php
// Enable debugging temporarily:
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

**Permission Issues:**
```bash
# Set correct permissions:
chmod 755 -R /path/to/insuranceV2
chmod 644 /path/to/insuranceV2/config/*.php
```

## 📞 Support Information

**Technical Support:**
- Email: info@softpromis.com
- Documentation: README.md
- Test Tool: test_setup.php

**System Information:**
- Version: 2.0
- PHP Framework: Custom Laravel-like structure
- Database: MySQL
- Frontend: Bootstrap 5 + Custom CSS
- Compatible: Hostinger Cloud Startup Plan

---

**Deployment completed successfully? Mark all items as checked! ✅**

*Insurance Management System v2.0 - Deployment Checklist*  
*© SoftPro Insurance Services*
