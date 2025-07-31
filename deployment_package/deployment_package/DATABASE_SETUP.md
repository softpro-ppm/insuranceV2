# Database Setup Guide

## Production Deployment (Hostinger)

Since you're deploying directly from GitHub Desktop to Hostinger, you don't need local setup!

### Database Configuration

Your production database credentials (already configured):
- **Host:** localhost
- **Database:** u820431346_v2insurance
- **Username:** u820431346_v2insurance
- **Password:** Softpro@123

### Setup Steps

1. **Access Hostinger cPanel/phpMyAdmin**
   - Login to your Hostinger hosting panel
   - Open phpMyAdmin or Database Manager

2. **Import Database Structure** (if not already done)
   - Select your database: `u820431346_v2insurance`
   - Go to Import tab
   - Upload the file: `database/init_database.sql`
   - Click "Go" to import

3. **Deploy via GitHub Desktop**
   - Commit your changes in GitHub Desktop
   - Push to main branch
   - Hostinger will automatically sync the files

4. **Access Your Application**
   - URL: https://v2.insurance.softpromis.com
   - Login: `admin` / `password`

### Troubleshooting

- **"Access denied" error:** Check database credentials in Hostinger panel
- **"Database not found" error:** Make sure database exists in Hostinger
- **"Table doesn't exist" error:** Import the database/init_database.sql file

### Default Login Credentials

After setting up the database, you can login with:
- **Username:** admin
- **Password:** password

The database initialization script automatically creates this admin user.

## Troubleshooting

- **"Access denied" error:** Check username/password in .env file
- **"Database not found" error:** Create the database first
- **"Connection refused" error:** Make sure MySQL server is running
- **PHP not found:** This is for server deployment, ensure PHP is installed on the server
