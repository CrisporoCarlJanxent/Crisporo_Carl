# ✅ Shared Database Configuration

## Your PROJECT now uses the SAME database as Crisporo_Carl!

---

## 🔗 Database Connection

Both projects now share:

**Database:** `sql12799933` at `sql12.freesqldatabase.com`

```
Host: sql12.freesqldatabase.com
Port: 3306
Username: sql12799933
Password: C2iyjsecfC
Database: sql12799933
```

---

## 📊 Shared Tables

### 1. **users** (Authentication)
Used by both projects for login/authentication

```sql
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) UNIQUE,
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('admin','user') DEFAULT 'user',
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

**Default Login:**
- Username: `admin`
- Password: `admin123`

---

### 2. **tournament_signups** (CRUD Operations)
Used by both projects for tournament team management

```sql
CREATE TABLE tournament_signups (
  id INT PRIMARY KEY AUTO_INCREMENT,
  team_name VARCHAR(100),
  captain_name VARCHAR(100),
  game_title VARCHAR(100),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

---

## 🔄 What Changed in Your PROJECT

### Files Updated:

1. **`app/config/database.php`**
   - Now uses sql12799933 database (same as Crisporo_Carl)

2. **`app/models/UserModel.php`**
   - Changed table from `users` to `tournament_signups`
   - Updated fields to: `team_name`, `captain_name`, `game_title`
   - Search now looks in team/captain/game fields

3. **`app/controllers/UserController.php`**
   - Updated to use tournament signup fields
   - Changed variable names from `$data['users']` to `$data['signups']`
   - Updated all CRUD operations

4. **`app/views/users/`**
   - Copied all view files from Crisporo_Carl
   - Views now display team/captain/game fields

5. **`database_setup.sql`**
   - Updated to create both tables
   - Includes sample data

---

## 🎯 How It Works

### Authentication (users table):
- Both projects share the same user accounts
- Login with `admin`/`admin123` works for both
- User accounts created in one project appear in the other

### CRUD Operations (tournament_signups table):
- Both projects work with the same tournament teams
- Teams added in Crisporo_Carl will appear in this PROJECT
- Teams added in this PROJECT will appear in Crisporo_Carl
- **Data is SHARED between both projects!**

---

## 🚀 Testing

### Test Locally:

1. Visit: `http://localhost/CRUD%20BIT/PROJECT/Decillo_John_Lexter/`
2. Login with: `admin` / `admin123`
3. You'll see the same teams as Crisporo_Carl

### Add a Team:

1. Login to your PROJECT
2. Click "Create" and add a team
3. Go to Crisporo_Carl - the team will be there!

---

## ⚠️ Important Notes

### Shared Data:
- **Any changes in one project affect the other**
- Deleting a team in PROJECT deletes it in Crisporo_Carl too
- Both projects read/write to the same database

### Field Differences:
- **Crisporo_Carl UserModel** uses `tournament_signups` (teams)
- **Your PROJECT UserModel** now also uses `tournament_signups` (teams)
- The `users` table is only for authentication, not CRUD

### Why This Setup:
- This matches how Crisporo_Carl works
- The project is about tournament team management
- Authentication is separate from the teams data

---

## 📝 Summary

**Before:**
- Your PROJECT had different database
- Different tables and fields
- No authentication

**After:**
- ✅ Same database as Crisporo_Carl
- ✅ Same tables (`users`, `tournament_signups`)
- ✅ Same authentication system
- ✅ Same tournament team data
- ✅ Full authentication with login/register
- ✅ Data is synchronized between both projects

---

## 🔧 If You Need Separate Data

If you want separate data for each project in the future:

1. Create a new database
2. Update `app/config/database.php` with new credentials
3. Run `database_setup.sql` on the new database

But for now, both projects share the same data!

---

**Your PROJECT is now a clone of Crisporo_Carl with authentication!** 🎉
