#!/bin/bash

# Insurance Management System v2.0 - Deployment Preparation Script
# This script prepares your files for Hostinger deployment

echo "🚀 Insurance Management System v2.0 - Deployment Preparation"
echo "=============================================================="

# Create deployment directory
DEPLOY_DIR="insurance_v2_deployment"
echo "📁 Creating deployment directory: $DEPLOY_DIR"
mkdir -p "$DEPLOY_DIR"

# Copy necessary files (excluding unnecessary ones)
echo "📋 Copying project files..."

# Core application files
cp -r app "$DEPLOY_DIR/"
cp -r config "$DEPLOY_DIR/"
cp -r database "$DEPLOY_DIR/"
cp -r public "$DEPLOY_DIR/"
cp -r resources "$DEPLOY_DIR/"

# Configuration files
cp .env "$DEPLOY_DIR/"
cp README.md "$DEPLOY_DIR/"

# Keep backup of old system (optional)
cp -r backup-old "$DEPLOY_DIR/" 2>/dev/null || echo "⚠️  backup-old directory not found, skipping..."

# Create deployment info file
cat > "$DEPLOY_DIR/DEPLOYMENT_INFO.txt" << EOF
Insurance Management System v2.0 - Deployment Package
=====================================================

Deployment Date: $(date)
Version: 2.0
Target: Hostinger Cloud Startup Plan

Files Included:
✅ app/ - Core application classes
✅ config/ - Configuration files  
✅ database/ - Database schema and migrations
✅ public/ - Web-accessible files (point domain here)
✅ resources/ - Views and templates
✅ .env - Environment configuration
✅ README.md - Documentation

IMPORTANT DEPLOYMENT STEPS:
===========================

1. UPLOAD TO HOSTINGER:
   - Upload all folders to public_html/
   - Point domain to public_html/public/ folder

2. CREATE DATABASE:
   - Name: u820431346_v2insurance
   - User: u820431346_v2insurance
   - Pass: Softpro@123

3. IMPORT DATABASE:
   - Use phpMyAdmin
   - Import: database/init_database.sql

4. TEST SYSTEM:
   - Visit: https://yourdomain.com
   - Login: admin / password

5. SECURE SYSTEM:
   - Change admin password
   - Remove test files
   - Disable error display

For detailed instructions, see README.md

Support: info@softpromis.com
EOF

# Set proper permissions for deployment
echo "🔧 Setting file permissions..."
find "$DEPLOY_DIR" -type f -exec chmod 644 {} \;
find "$DEPLOY_DIR" -type d -exec chmod 755 {} \;

# Make sure critical files have correct permissions
chmod 644 "$DEPLOY_DIR/config/"*.php
chmod 644 "$DEPLOY_DIR/.env"
chmod 755 "$DEPLOY_DIR/public"

# Create a zip file for easy upload
echo "📦 Creating deployment package..."
zip -r "${DEPLOY_DIR}.zip" "$DEPLOY_DIR" -x "*.DS_Store" "*/node_modules/*" "*/.git/*"

echo ""
echo "✅ Deployment preparation complete!"
echo ""
echo "📦 Deployment package: ${DEPLOY_DIR}.zip"
echo "📁 Deployment folder: $DEPLOY_DIR/"
echo ""
echo "🚀 Next Steps:"
echo "1. Upload ${DEPLOY_DIR}.zip to Hostinger"
echo "2. Extract in public_html/"
echo "3. Follow DEPLOYMENT_INFO.txt instructions"
echo ""
echo "📚 For detailed guide, see DEPLOYMENT_GUIDE.md"
EOF
