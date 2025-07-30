# 🚀 HOSTINGER DEPLOYMENT - Quick Start Guide

## 📦 Files Ready for Upload
Your deployment package is ready in the `deployment_package/` folder.

## 🎯 Step-by-Step Deployment Process

### Step 1: Access Hostinger Control Panel
1. Go to: https://hpanel.hostinger.com/
2. Login with your Hostinger credentials
3. Select your hosting account

### Step 2: Create MySQL Database
1. **Navigate to:** Websites → Manage → Databases → MySQL Databases
2. **Create Database:**
   - Database Name: `u820431346_v2insurance`
   - Username: `u820431346_v2insurance`
   - Password: `Softpro@123`
3. **Important:** Note down the database HOST (usually localhost)

### Step 3: Upload Files
1. **Go to:** File Manager in hPanel
2. **Navigate to:** `public_html` folder
3. **Upload Method:** Either:
   
   **Option A: Direct Upload**
   - Select all files from `deployment_package/` folder
   - Drag and drop into `public_html/`
   
   **Option B: ZIP Upload** 
   - Create ZIP of `deployment_package/` contents
   - Upload ZIP to `public_html/`
   - Extract the ZIP file

### Step 4: Configure Domain Pointing
1. **In File Manager:** You should see this structure in `public_html/`:
   ```
   public_html/
   ├── app/
   ├── config/
   ├── database/
   ├── resources/
   ├── public/          ← Point your domain HERE
   ├── .env
   └── README.md
   ```
2. **Set Document Root:** 
   - Go to Websites → Manage → Advanced → Change Website Root
   - Set to: `public_html/public`

### Step 5: Import Database
1. **Access phpMyAdmin:** Databases → phpMyAdmin
2. **Select Database:** `u820431346_v2insurance`
3. **Import:**
   - Click "Import" tab
   - Choose file: Upload the `database/init_database.sql` file
   - Click "Go" to execute

### Step 6: Test Your Website
1. **Visit:** https://yourdomain.com
2. **Expected:** Login page should appear
3. **Login with:**
   - Username: `admin`
   - Password: `password`

## ✅ Verification Checklist

After deployment, verify these work:
- [ ] Website loads (no errors)
- [ ] Login page appears
- [ ] Admin login successful
- [ ] Dashboard displays with data
- [ ] Policies → Add New Policy works
- [ ] Customer dropdown populates
- [ ] Insurance type selection works

## 🔧 If Something Goes Wrong

### Common Issues:

**1. Database Connection Error:**
- Check database name, username, password in hPanel
- Verify `config/database.php` has correct details

**2. 500 Internal Server Error:**
- Check file permissions in File Manager
- Look at Error Logs in hPanel

**3. Page Not Found (404):**
- Ensure domain points to `public_html/public/` folder
- Check `.htaccess` file exists in public folder

**4. Blank/White Page:**
- Check PHP error logs in hPanel
- Verify all files uploaded correctly

## 📞 Support

If you need help:
1. Check Error Logs in hPanel
2. Email: info@softpromis.com
3. Share error messages for faster help

## 🎉 Success!

Once working, you'll have:
- ✅ Full Insurance Management System
- ✅ Motor, Health & Life Insurance support
- ✅ Customer management
- ✅ Policy creation and tracking
- ✅ Renewal management
- ✅ Commission calculations

**Next:** Change admin password and start adding your real data!

---
*Insurance Management System v2.0 - Deployment Guide*
