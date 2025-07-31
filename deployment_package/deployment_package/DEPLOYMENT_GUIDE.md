# 🚀 Insurance Management System v2.0 - Complete Deployment Guide

## 📋 Prerequisites Check

Based on your current setup, here's what we need to do:

### Current Status:
✅ **Project Files:** Complete and ready  
✅ **Database Config:** Set up for Hostinger  
❌ **PHP:** Not installed locally  
❌ **Database:** Needs to be created on Hostinger  

---

## Part A: Local Development Setup (Optional)

### Step A1: Install PHP on macOS

```bash
# Install Homebrew (if not installed)
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Add Homebrew to PATH
echo 'eval "$(/opt/homebrew/bin/brew shellenv)"' >> ~/.zshrc
source ~/.zshrc

# Install PHP
brew install php

# Verify installation
php --version
```

### Step A2: Install MySQL (Optional for local testing)

```bash
# Install MySQL
brew install mysql

# Start MySQL service
brew services start mysql

# Secure installation (set root password)
mysql_secure_installation
```

### Step A3: Test Local Setup

```bash
cd /Users/rajesh/Documents/GitHub/insuranceV2

# Test setup
php test_setup.php

# If database connection fails, create local database:
mysql -u root -p
CREATE DATABASE u820431346_v2insurance;
exit

# Import schema
mysql -u root -p u820431346_v2insurance < database/init_database.sql

# Start development server
php -S localhost:8000 -t public
```

---

## Part B: Hostinger Production Deployment (Recommended)

Since you already have Hostinger hosting, let's deploy directly to production:

### Step B1: Access Hostinger Control Panel

1. **Login to Hostinger:** https://www.hostinger.com/cpanel-login
2. **Access hPanel:** Your hosting control panel

### Step B2: Create MySQL Database

1. **Navigate to:** Databases → MySQL Databases
2. **Create Database:**
   - Database Name: `u820431346_v2insurance`
   - Username: `u820431346_v2insurance` 
   - Password: `Softpro@123` (already in your config)
3. **Note down:** Database details (host, name, user, password)

### Step B3: Upload Project Files

#### Option 1: File Manager (Recommended)
1. **Open:** File Manager in hPanel
2. **Navigate to:** `public_html` folder
3. **Create Structure:**
   ```
   public_html/
   ├── app/
   ├── config/
   ├── database/
   ├── resources/
   ├── backup-old/
   ├── .env
   ├── README.md
   └── public/ (your domain should point here)
   ```
4. **Upload Files:** Drag and drop all project folders/files

#### Option 2: FTP Upload
```bash
# Using FileZilla or similar FTP client:
Host: your-domain.com or server IP
Username: your hosting username
Password: your hosting password
Port: 21 (or 22 for SFTP)

# Upload all files to public_html/
```

### Step B4: Configure Domain

1. **In hPanel:** Navigate to Domains
2. **Set Document Root:** Point your domain to `public_html/public` folder
3. **Enable SSL:** If not already enabled

### Step B5: Initialize Database

1. **Access phpMyAdmin:** From hPanel → Databases → phpMyAdmin
2. **Select Database:** `u820431346_v2insurance`
3. **Import SQL:** Go to Import tab
4. **Upload File:** Select `database/init_database.sql` from your computer
5. **Execute:** Click "Go" to import

### Step B6: Test Deployment

1. **Visit Your Domain:** https://yourdomain.com
2. **Expected:** Login page should appear
3. **Login Credentials:**
   - Username: `admin`
   - Password: `password`

---

## 🔧 Configuration Files Setup

### Update .env file (if needed):

```ini
APP_NAME="Insurance Management System v2.0"
APP_ENV=production
APP_DEBUG=false

# Your Hostinger Database Details
DB_HOST=localhost
DB_DATABASE=u820431346_v2insurance
DB_USERNAME=u820431346_v2insurance
DB_PASSWORD=Softpro@123
```

### Verify .htaccess in public folder:

```apache
RewriteEngine On

# Handle Angular and other client-side routing
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"

# Cache static assets
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType image/png "access plus 1 month"
    ExpiresByType image/jpg "access plus 1 month"
    ExpiresByType image/jpeg "access plus 1 month"
</IfModule>
```

---

## 🧪 Testing Checklist

### After Deployment, Test These Features:

#### ✅ Authentication
- [ ] Login page loads
- [ ] Admin login works (admin/password)
- [ ] Dashboard displays
- [ ] Logout works

#### ✅ Core Features
- [ ] Policies → Add New Policy loads
- [ ] Customer dropdown populates
- [ ] Insurance type selection works
- [ ] Form submission creates policy
- [ ] Policies list shows data

#### ✅ Database
- [ ] All 9 tables created
- [ ] Demo data visible
- [ ] API endpoints return JSON

#### ✅ UI/Design
- [ ] Bootstrap styling loads
- [ ] Responsive on mobile
- [ ] Icons display properly
- [ ] Forms validate correctly

---

## 🚨 Troubleshooting Guide

### Common Issues & Solutions:

#### **500 Internal Server Error**
```apache
# Check .htaccess syntax in public/ folder
# Verify file permissions: 644 for files, 755 for folders
# Check error logs in hPanel → Error Logs
```

#### **Database Connection Error**
```php
// Verify database credentials in config/database.php
// Check if database exists in phpMyAdmin
// Test connection with simple PHP script
```

#### **Blank Page/White Screen**
```php
// Add to top of public/index.php temporarily:
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

#### **404 Errors for Routes**
```apache
# Ensure .htaccess exists in public/ folder
# Check mod_rewrite is enabled on server
# Verify domain points to public/ directory
```

---

## 🔒 Security Hardening

### After Deployment:

#### 1. Change Default Credentials
```sql
-- Login to phpMyAdmin and run:
UPDATE users SET password = '$2y$10$your_new_hashed_password' WHERE username = 'admin';
```

#### 2. Remove Test Files
```bash
# Delete these files after successful deployment:
- test_setup.php
- DEPLOYMENT.md
```

#### 3. Disable Error Display
```php
// In public/index.php, ensure:
error_reporting(0);
ini_set('display_errors', 0);
```

---

## 📞 Next Steps After Deployment

### 1. **Immediate Tasks:**
- [ ] Test all functionality
- [ ] Change admin password
- [ ] Add your company logo
- [ ] Update company information

### 2. **Data Migration from v1.0:**
- [ ] Export customers from old system
- [ ] Export policies from old system
- [ ] Import into new database structure

### 3. **Customization:**
- [ ] Add your branding
- [ ] Configure email settings
- [ ] Set up backup schedule

---

## 📧 Support

If you encounter any issues:

1. **Check Error Logs:** hPanel → Error Logs
2. **PHP Errors:** Enable error reporting temporarily
3. **Database Issues:** Use phpMyAdmin to check
4. **Contact:** info@softpromis.com

---

**🎉 Once deployed successfully, you'll have a fully functional Insurance Management System v2.0 running on Hostinger!**

*Next: I'll help you with specific steps as you go through the deployment process.*
