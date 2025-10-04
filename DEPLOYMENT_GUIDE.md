# Deployment Guide for Render

## Issues Fixed

Your application was showing a white screen on Render due to the following issues:

### 1. **Production Environment Hiding Errors**
- **Problem**: `ENVIRONMENT` was set to `production` in `app/config/config.php`, which suppresses all error messages
- **Fix**: Changed to `development` temporarily to see errors
- **Action After Deploy**: Once everything works, you can switch back to `production`

### 2. **Session Directory Not Writable**
- **Problem**: Session save path was set to `/tmp` which may not be writable on Render
- **Fix**: Changed session path to `runtime/sessions` (relative to your app)
- **Update**: Modified `Dockerfile` to create and set proper permissions for runtime directories

### 3. **Missing Runtime Directories**
- **Problem**: Required directories (`runtime/sessions`, `runtime/logs`, `runtime/cache`) didn't exist
- **Fix**: Created these directories and updated `Dockerfile` to ensure they exist on deployment

## Files Modified

1. **app/config/config.php**
   - Line 67: Changed `$config['ENVIRONMENT']` from `'production'` to `'development'`
   - Line 217: Changed `$config['sess_save_path']` from `'/tmp'` to `ROOT_DIR . 'runtime/sessions'`

2. **Dockerfile**
   - Added commands to create runtime directories
   - Set proper permissions (777) for runtime directories

3. **.gitignore**
   - Updated to include runtime subdirectories in git

4. **New File: debug_render.php**
   - Diagnostic script to check server configuration
   - Access at: `https://crisporo-carl.onrender.com/debug_render.php`
   - **IMPORTANT**: Delete this file after debugging!

## Deployment Steps

### 1. Commit and Push Changes

```bash
git add .
git commit -m "Fix: Render deployment - session path, runtime dirs, error visibility"
git push origin main
```

### 2. Trigger Render Deployment

Render should automatically deploy when you push to your repository. If not:
- Go to your Render dashboard
- Click "Manual Deploy" → "Clear build cache & deploy"

### 3. Check Debug Information

After deployment, visit:
```
https://crisporo-carl.onrender.com/debug_render.php
```

This will show you:
- PHP version
- File permissions
- Database connection status
- Session configuration
- Apache mod_rewrite status

### 4. Test Your Application

Once the debug script shows everything is working:
1. Visit: `https://crisporo-carl.onrender.com/`
2. You should be redirected to login or see the homepage
3. If you see errors now (instead of white screen), that's progress!

### 5. Fix Any Remaining Errors

With `development` mode enabled, you'll now see actual error messages. Common issues:

#### Database Connection Errors
- Verify database credentials in `app/config/database.php`
- Check if the external database is accessible from Render's servers

#### Missing Tables
- Run your database migrations
- Import the SQL file: `create_admins.sql`

#### Permission Errors
- All runtime directories should be writable (check debug_render.php)

## After Everything Works

### Switch Back to Production Mode

Once your app is working perfectly:

1. Edit `app/config/config.php` line 67:
   ```php
   $config['ENVIRONMENT'] = 'production';
   ```

2. Remove the debug file:
   ```bash
   git rm debug_render.php
   ```

3. Commit and deploy:
   ```bash
   git add .
   git commit -m "Switch to production mode and remove debug script"
   git push origin main
   ```

## Troubleshooting

### Still Seeing White Screen?

1. Check Render logs:
   - Go to Render Dashboard
   - Click on your service
   - Click "Logs" tab
   - Look for PHP errors

2. Check PHP error log:
   - Logs are written to `runtime/logs/`
   - Access via Render Shell or check in logs

### Session Issues?

If sessions aren't working:
- Verify `runtime/sessions` exists and is writable (777 permissions)
- Check `debug_render.php` for session status

### Database Connection Failed?

- Verify database credentials
- Check if your database provider allows connections from Render's IP ranges
- Free database providers might have connection limits

### 404 Errors on Routes?

- Verify `.htaccess` file exists
- Check if Apache `mod_rewrite` is enabled (shown in debug_render.php)
- Render might need specific configuration for URL rewriting

## Important Notes

1. **Security**: The `development` environment shows detailed errors. Switch to `production` once stable.

2. **Session Storage**: Sessions are now stored in `runtime/sessions` directory, which is writable by the web server.

3. **Database**: Your app uses a free external MySQL database. Be aware of:
   - Connection limits
   - Storage limits
   - Potential downtime

4. **Logs**: Application logs are stored in `runtime/logs/`. Monitor these for issues.

5. **Base URL**: Currently set to `https://crisporo-carl.onrender.com/` in `app/config/config.php`

## Quick Reference

### Key Configuration Files
- `app/config/config.php` - Main configuration
- `app/config/database.php` - Database credentials
- `app/config/routes.php` - URL routing
- `Dockerfile` - Container configuration

### Important Directories
- `runtime/sessions/` - Session files
- `runtime/logs/` - Application logs
- `runtime/cache/` - Cache files
- `app/controllers/` - Your controllers
- `app/views/` - Your views

### Default Routes
- `/` or `/users/view` - Main page (requires login)
- `/auth/login` - Login page
- `/auth/register` - Registration page
- `/auth/logout` - Logout

## Need More Help?

If you're still experiencing issues:

1. Check the Render logs for specific errors
2. Run `debug_render.php` and share the output
3. Check if the database is accessible
4. Verify all files were uploaded correctly

Good luck with your deployment! 🚀
