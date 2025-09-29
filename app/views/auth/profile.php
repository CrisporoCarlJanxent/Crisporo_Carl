<!DOCTYPE html>
<html>
<head>
    <title>Profile - Tournament Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-cyan: #00d4ff;
            --secondary-purple: #8b5cf6;
            --accent-green: #10b981;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --border-color: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --error-red: #ef4444;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1e293b 100%);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .profile-header {
            background: var(--card-bg);
            border: 2px solid var(--primary-cyan);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 212, 255, 0.1);
            padding: 24px;
            margin-bottom: 24px;
            text-align: center;
        }

        .profile-title {
            font-family: 'Orbitron', monospace;
            font-size: 28px;
            color: var(--primary-cyan);
            font-weight: 700;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
            margin-bottom: 8px;
        }

        .profile-subtitle {
            color: var(--text-secondary);
            font-size: 16px;
        }

        .profile-card {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
        }

        .card-title {
            margin: 0;
            font-size: 20px;
            color: var(--primary-cyan);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-cyan);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background: var(--dark-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-cyan);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
            background: var(--dark-bg);
        }

        .form-control:disabled {
            background: var(--card-bg);
            color: var(--text-secondary);
            cursor: not-allowed;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 212, 255, 0.3);
            color: white;
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-cyan);
            color: var(--primary-cyan);
        }

        .btn-danger {
            background: var(--error-red);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            color: white;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error-red);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            color: var(--error-red);
            font-size: 14px;
            text-align: center;
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--accent-green);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            color: var(--accent-green);
            font-size: 14px;
            text-align: center;
        }

        .user-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .info-item {
            background: var(--dark-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 16px;
            text-align: center;
        }

        .info-label {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            color: var(--text-primary);
            font-weight: 600;
        }

        .role-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-admin {
            background: rgba(239, 68, 68, 0.2);
            color: var(--error-red);
            border: 1px solid var(--error-red);
        }

        .role-user {
            background: rgba(16, 185, 129, 0.2);
            color: var(--accent-green);
            border: 1px solid var(--accent-green);
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-cyan);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .back-link:hover {
            color: var(--secondary-purple);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= site_url('users/view') ?>" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Back to Teams
        </a>

        <div class="profile-header">
            <h1 class="profile-title">
                <i class="fas fa-user-circle"></i>
                User Profile
            </h1>
            <p class="profile-subtitle">Manage your account settings</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="user-info">
            <div class="info-item">
                <div class="info-label">Username</div>
                <div class="info-value"><?= htmlspecialchars($user['username']) ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value"><?= htmlspecialchars($user['email']) ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Role</div>
                <div class="info-value">
                    <span class="role-badge role-<?= $user['role'] ?>">
                        <?= strtoupper($user['role']) ?>
                    </span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Member Since</div>
                <div class="info-value"><?= date('M d, Y', strtotime($user['created_at'])) ?></div>
            </div>
        </div>

        <div class="profile-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Update Profile
                </h3>
            </div>
            <div class="card-body">
                <form action="<?= site_url('auth/update_profile') ?>" method="POST">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control" 
                               value="<?= htmlspecialchars($user['username']) ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control" 
                               value="<?= htmlspecialchars($user['email']) ?>"
                               required>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="profile-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-lock"></i>
                    Change Password
                </h3>
            </div>
            <div class="card-body">
                <form action="<?= site_url('auth/change_password') ?>" method="POST">
                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" 
                               name="current_password" 
                               id="current_password" 
                               class="form-control" 
                               placeholder="Enter current password"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" 
                               name="new_password" 
                               id="new_password" 
                               class="form-control" 
                               placeholder="Enter new password"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" 
                               name="confirm_password" 
                               id="confirm_password" 
                               class="form-control" 
                               placeholder="Confirm new password"
                               required>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="profile-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-sign-out-alt"></i>
                    Account Actions
                </h3>
            </div>
            <div class="card-body">
                <div class="actions">
                    <a href="<?= site_url('auth/logout') ?>" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password confirmation validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = this.value;
            
            if (newPassword !== confirmPassword) {
                this.style.borderColor = '#ef4444';
            } else {
                this.style.borderColor = '#10b981';
            }
        });
    </script>
</body>
</html>
