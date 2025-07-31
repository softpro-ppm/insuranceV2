# Database Setup Guide

## For Local Development

If you're getting database connection errors, follow these steps:

### Option 1: Use Local MySQL (Recommended for Development)

1. **Install MySQL** (via XAMPP, MAMP, or standalone MySQL)

2. **Copy the local environment file:**
   ```bash
   cp .env.local .env
   ```

3. **Create the local database:**
   ```sql
   CREATE DATABASE insurance_v2_local CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

4. **Import the database structure:**
   ```bash
   mysql -u root -p insurance_v2_local < database/init_database.sql
   ```

5. **Access the application:**
   ```
   http://localhost:8000
   ```

### Option 2: Use Production Database

If you have access to the production database:

1. **Keep the current .env file** with production credentials
2. **Make sure the credentials are correct:**
   - Host: localhost (or production server IP)
   - Database: u820431346_v2insurance
   - Username: u820431346_v2insurance
   - Password: Softpro@123

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
