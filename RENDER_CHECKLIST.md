# 🚀 Render Deployment Checklist

## ✅ Pre-Deployment Checklist

### Files Modified
- [x] `app/config/config.php` - Environment and session path fixed
- [x] `Dockerfile` - Runtime directories and permissions added
- [x] `.gitignore` - Updated to include runtime subdirectories
- [x] Runtime directories created (sessions, logs, cache)

### Configuration Verified
- [x] Base URL: `https://crisporo-carl.onrender.com/`
- [x] Environment: `development` (for debugging)
- [x] Database credentials: Set in `app/config/database.php`
- [x] Session path: `runtime/sessions`

## 📋 Deployment Steps

### Step 1: Commit Changes
```bash
cd "c:\wamp64\www\CRUD BIT\Crisporo_Carl"
git add .
git commit -m "Fix Render deployment: error visibility, sessions, and permissions"
git push origin main
```

### Step 2: Monitor Render Deployment
1. Go to https://dashboard.render.com
2. Select your service: `crisporo-carl`
3. Watch the "Events" tab for deployment progress
4. Check "Logs" tab for any errors during build/deploy

### Step 3: Run Diagnostics
Visit: **https://crisporo-carl.onrender.com/debug_render.php**

Check for:
- ✅ PHP version (should be 8.2)
- ✅ All files exist
- ✅ Runtime directories are writable
- ✅ Database connection successful
- ✅ Sessions working
- ✅ mod_rewrite enabled

### Step 4: Test Application
Visit: **https://crisporo-carl.onrender.com/**

Expected behavior:
- Should redirect to `/auth/login` if not logged in
- OR show actual PHP errors (not white screen)

### Step 5: Create Admin Account (if needed)
If you need to create an admin account:
1. Check if `create_admins.sql` has been run on your database
2. Or use the setup route: `/setup/admin`
3. Or register a new user at: `/auth/register`

## 🐛 Troubleshooting Guide

### White Screen Still Appears?

**Check Render Logs:**
```
Dashboard → Your Service → Logs
```

Look for:
- Build errors
- PHP fatal errors
- Apache errors

**Access Shell:**
```
Dashboard → Your Service → Shell
```

Check permissions:
```bash
ls -la /var/www/html/runtime/
```

### Database Connection Failed?

1. Verify credentials in `app/config/database.php`:
   - Host: sql12.freesqldatabase.com
   - Database: sql12799933
   - Username: sql12799933
   - Password: C2iyjsecfC

2. Check if database is accessible:
   - Visit debug_render.php for connection test
   - Free databases may have uptime limitations

3. Import schema if needed:
   - Use `create_admins.sql`
   - Or check `database/` folder for migrations

### Session Errors?

Check if directory exists and is writable:
- Path: `/var/www/html/runtime/sessions`
- Permissions: 777 (full read/write)
- Check via debug_render.php

### 404 Errors on All Pages?

1. Verify `.htaccess` exists:
   ```bash
   ls -la /var/www/html/.htaccess
   ```

2. Check if mod_rewrite is enabled:
   - Should show in debug_render.php
   - Or check Apache config

3. Base URL configuration:
   - Must match your Render domain
   - Currently: `https://crisporo-carl.onrender.com/`

### PHP Errors Now Visible?

Good! This means the fix is working. Now you can:
1. See the actual error message
2. Fix the root cause
3. Deploy the fix

Common errors and solutions:

**Undefined function/class:**
- Check autoload in `app/config/autoload.php`
- Verify file exists in correct location

**Database table doesn't exist:**
- Run migrations or import SQL schema
- Check table names match your queries

**Permission denied:**
- Check file/directory permissions
- Ensure runtime directories are writable (777)

## 🔄 After Everything Works

### Switch to Production Mode

1. Edit `app/config/config.php` line 67:
   ```php
   $config['ENVIRONMENT'] = 'production';
   ```

2. Increase log threshold (line 110):
   ```php
   $config['log_threshold'] = 1; // Only exceptions and errors
   ```

3. Remove debug files:
   ```bash
   git rm debug_render.php
   git rm RENDER_CHECKLIST.md  # Optional
   git rm FIXES_APPLIED.txt     # Optional
   ```

4. Commit and deploy:
   ```bash
   git add .
   git commit -m "Switch to production mode"
   git push origin main
   ```

## 📊 Monitoring

### Check Application Health

**Regular checks:**
- Application loads without errors
- Login/logout works
- Database operations work
- Sessions persist across requests

**Monitor logs:**
- Location: `runtime/logs/`
- Access via Render Shell or download
- Check for warnings/errors

**Database monitoring:**
- Free tier limitations
- Connection count
- Storage usage
- Query performance

## 🔐 Security Recommendations

### Before Going Live:

1. **Change to production mode** (hides errors from users)

2. **Remove debug tools:**
   - debug_render.php
   - Any test scripts

3. **Secure database credentials:**
   - Consider using environment variables
   - Don't commit sensitive data to public repos

4. **Enable CSRF protection** (line 296 in config.php):
   ```php
   $config['csrf_protection'] = TRUE;
   ```

5. **Use HTTPS only** (already configured)

6. **Set secure session settings:**
   ```php
   $config['sess_match_ip'] = TRUE;
   $config['sess_match_fingerprint'] = TRUE;
   ```

## 📞 Quick Reference

### Important URLs
- **Application:** https://crisporo-carl.onrender.com/
- **Debug Tool:** https://crisporo-carl.onrender.com/debug_render.php
- **Login:** https://crisporo-carl.onrender.com/auth/login
- **Register:** https://crisporo-carl.onrender.com/auth/register

### Important Files
- **Main Config:** `app/config/config.php`
- **Database Config:** `app/config/database.php`
- **Routes:** `app/config/routes.php`
- **Autoload:** `app/config/autoload.php`

### Important Commands
```bash
# View logs in Render Shell
tail -f /var/www/html/runtime/logs/*.log

# Check permissions
ls -la /var/www/html/runtime/

# Test database connection
php -r "new PDO('mysql:host=sql12.freesqldatabase.com;dbname=sql12799933', 'sql12799933', 'C2iyjsecfC');"
```

## ✨ Summary

**What was fixed:**
1. Changed environment to `development` to see errors
2. Fixed session path to use writable local directory
3. Created runtime directories with proper permissions
4. Updated Dockerfile for proper deployment structure

**What to do now:**
1. Commit and push changes
2. Wait for Render to deploy
3. Visit debug_render.php to verify setup
4. Test your application
5. Fix any remaining errors that are now visible
6. Switch back to production mode when stable

**Remember:** The white screen was caused by production mode hiding errors. Now you'll see actual error messages that will help you fix the real issues!

Good luck! 🎉
