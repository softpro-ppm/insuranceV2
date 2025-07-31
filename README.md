# Insurance Management System v2.0

## 🚀 MASSIVE DATA UPDATE - July 31, 2025

### ✅ COMPLETED FEATURES:
- **500 Customers** with realistic Indian data across 50+ cities
- **700 Policies** across Motor, Health, Life, Travel & Property categories  
- **5 Agent Accounts** with phone-based login system
- **23 Insurance Companies** with complete contact information
- **Document Upload System** for KYC and Policy documents
- **Agent Performance Tracking** with realistic metrics
- **Revenue Data**: ₹2.5+ Crores in premiums across 3 FY years

### 📋 NEW DIAGNOSTIC TOOLS:
- `diagnosis.php` - Complete system health checker
- `test_data_load.php` - Direct massive data loader
- Fixed login pages with clean CSS
- Enhanced setup.php with proper success messages

### 🔗 DEPLOYMENT READY:
- All files committed to GitHub
- Ready for Hostinger deployment
- Database initialization scripts ready

### 🎯 NEXT STEPS FOR DEPLOYMENT:
1. Pull latest changes from GitHub to Hostinger
2. Run `/setup.php` to initialize database
3. Use `/diagnosis.php` to verify data loading
4. Test login systems (admin & agent portals)

---
**Last Updated**: July 31, 2025 - Production Ready

A comprehensive insurance management system built with PHP supporting Motor, Health, and Life insurance policies.

## Features

### 🚗 Motor Insurance
- Vehicle registration and tracking
- Comprehensive and Third-party policies
- Vehicle details management (make, model, year, etc.)
- Fuel type tracking

### 🏥 Health Insurance
- Individual and Family coverage
- Plan management
- Pre-existing disease tracking
- Room rent limits

### 💼 Life Insurance
- Term and Whole life policies
- Maturity amount calculations
- Death benefit management
- Policy term tracking

### 💼 General Features
- Multi-user system (Admin, Agents, Employees)
- Customer management
- Policy renewals tracking
- Commission calculations
- Follow-up management
- Dashboard with statistics
- Document management
- Responsive design

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or PHP built-in server

## Installation Guide

### Step 1: Clone or Download
```bash
# If using Git
git clone <repository-url>
cd insuranceV2

# Or download and extract the ZIP file
```

### Step 2: Database Setup

1. **Create MySQL Database:**
   ```sql
   CREATE DATABASE u820431346_v2insurance CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. **Update Database Configuration:**
   Edit `config/database.php` with your database credentials:
   ```php
   <?php
   return [
       'host' => 'localhost',
       'username' => 'your_username',
       'password' => 'your_password',
       'database' => 'u820431346_v2insurance',
       'charset' => 'utf8mb4'
   ];
   ```

3. **Initialize Database:**
   Run the SQL script in your MySQL client:
   ```bash
   mysql -u your_username -p u820431346_v2insurance < database/init_database.sql
   ```

### Step 3: Test Setup
Run the test file to verify everything is working:
```bash
php test_setup.php
```

### Step 4: Start the Server

#### For Development:
```bash
cd /path/to/insuranceV2
php -S localhost:8000 -t public
```

#### For Production (Hostinger/Shared Hosting):
1. Upload all files to your hosting account
2. Point your domain to the `public` directory
3. Ensure `.htaccess` is working for URL rewriting

### Step 5: Login
- **URL:** http://localhost:8000 (development) or your domain
- **Username:** admin
- **Password:** password

## Project Structure

```
insuranceV2/
├── app/
│   └── Database.php              # Database connection class
├── config/
│   ├── app.php                   # Application configuration
│   └── database.php              # Database configuration
├── database/
│   └── init_database.sql         # Database schema and demo data
├── public/
│   ├── index.php                 # Main application entry point
│   ├── .htaccess                 # Apache rewrite rules
│   └── assets/                   # CSS, JS, images from v1.0
├── resources/
│   └── views/                    # All view templates
│       ├── layouts/
│       ├── auth/
│       ├── dashboard/
│       ├── policies/
│       ├── customers/
│       └── renewals/
├── backup-old/                   # Original v1.0 system backup
├── .env                          # Environment variables
└── README.md                     # This file
```

## Usage Guide

### Dashboard
- View system statistics
- Quick access to recent policies
- Renewal reminders

### Customer Management
- Add new customers
- Manage customer information
- View customer policies

### Policy Management
- **Create Policy:** Step-by-step wizard for different insurance types
- **View Policies:** List all policies with filtering
- **Renewals:** Track and manage policy renewals

### User Management (Admin only)
- Add agents and employees
- Manage user permissions
- View user activities

## API Endpoints

The system includes several AJAX endpoints for dynamic functionality:

- `GET /api/customers` - Fetch all customers
- `GET /api/policy-types?category=motor` - Get policy types by category
- `GET /api/insurance-companies?category=motor` - Get companies by category

## Configuration

### Environment Variables (.env)
```
APP_NAME="Insurance Management System v2.0"
APP_ENV=development
DB_HOST=localhost
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_DATABASE=u820431346_v2insurance
```

### Database Configuration
Update `config/database.php` with your hosting provider's database details.

## Hostinger Deployment

This system is optimized for Hostinger Cloud Startup plan:

1. **Upload Files:** Use File Manager or FTP to upload all files
2. **Database:** Create MySQL database in Hostinger control panel
3. **Domain:** Point your domain to the `public` directory
4. **SSL:** Enable SSL certificate in Hostinger panel

### Hostinger File Structure
```
public_html/              # Your domain root
├── public/              # Point domain here
│   ├── index.php
│   ├── .htaccess
│   └── assets/
├── app/
├── config/
├── database/
└── resources/
```

## Security Features

- Password hashing using PHP's password_hash()
- SQL injection prevention with prepared statements
- CSRF protection (sessions)
- Input validation and sanitization
- Secure file upload handling

## Troubleshooting

### Common Issues:

1. **Database Connection Error:**
   - Check database credentials in `config/database.php`
   - Ensure MySQL service is running
   - Verify database exists

2. **Page Not Found (404):**
   - Check `.htaccess` is present in public directory
   - Ensure mod_rewrite is enabled
   - Verify file permissions

3. **PHP Errors:**
   - Check PHP version (minimum 7.4)
   - Enable error reporting for debugging
   - Check server error logs

### Debug Mode:
Add this to the top of `public/index.php` for debugging:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## Demo Data

The system comes with demo data including:
- Admin user (admin/password)
- 5 sample customers
- 5 sample policies (motor, health, life)
- Insurance companies
- Policy types

## Support

For technical support or questions:
- Email: info@softpromis.com
- Create an issue in the repository

## License

This project is proprietary software developed for SoftPro Insurance Services.

## Version History

- **v2.0** - Complete rebuild with Laravel-like structure, multi-insurance support
- **v1.0** - Original PHP system (backed up in `backup-old/`)

---

**Insurance Management System v2.0**  
*Developed by SoftPro • Built with PHP & MySQL*
insuranceV2
