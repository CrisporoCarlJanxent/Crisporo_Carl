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
            --dark-bg: #0a0e1a;
            --card-bg: #141b2d;
            --border-color: #1e2738;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --error-red: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: radial-gradient(ellipse at top, #1a1f35 0%, var(--dark-bg) 50%, #000 100%);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            padding: clamp(15px, 3vw, 20px);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(0, 212, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-header {
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.95) 0%, rgba(20, 27, 45, 0.8) 100%);
            border: 2px solid transparent;
            border-radius: 20px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                0 0 40px rgba(0, 212, 255, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            padding: clamp(20px, 4vw, 24px);
            margin-bottom: clamp(20px, 3vw, 24px);
            text-align: center;
            backdrop-filter: blur(15px);
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 2px;
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple), var(--primary-cyan));
            background-size: 200% 200%;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            animation: borderFlow 3s linear infinite;
        }

        @keyframes borderFlow {
            to { background-position: 200% 200%; }
        }

        .profile-title {
            font-family: 'Orbitron', monospace;
            font-size: clamp(1.5rem, 5vw, 1.75rem);
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple), var(--primary-cyan));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            text-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
            margin-bottom: 8px;
            animation: shimmer 3s linear infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes shimmer {
            to { background-position: 200% center; }
        }

        .profile-title i {
            -webkit-text-fill-color: var(--primary-cyan);
            filter: drop-shadow(0 0 10px rgba(0, 212, 255, 0.5));
        }

        .profile-subtitle {
            color: var(--text-secondary);
            font-size: clamp(14px, 3vw, 16px);
            position: relative;
            z-index: 1;
        }

        .profile-card {
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.95) 0%, rgba(20, 27, 45, 0.8) 100%);
            border: 2px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            overflow: hidden;
            margin-bottom: clamp(20px, 3vw, 24px);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 25px 70px rgba(0, 0, 0, 0.6),
                0 0 0 1px rgba(0, 212, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }

        .card-header {
            padding: clamp(16px, 3vw, 20px) clamp(20px, 4vw, 24px);
            border-bottom: 2px solid transparent;
            border-image: linear-gradient(90deg, transparent, var(--primary-cyan), transparent) 1;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
        }

        .card-title {
            margin: 0;
            font-size: clamp(16px, 3.5vw, 20px);
            color: var(--primary-cyan);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        .card-body {
            padding: clamp(20px, 4vw, 24px);
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
            padding: clamp(10px, 2vw, 12px) clamp(14px, 3vw, 16px);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            background: rgba(10, 14, 26, 0.8);
            color: var(--text-primary);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: clamp(14px, 3vw, 16px);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-cyan);
            box-shadow: 
                0 0 0 3px rgba(0, 212, 255, 0.15),
                0 0 20px rgba(0, 212, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            background: rgba(10, 14, 26, 0.95);
            transform: translateY(-1px);
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
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .btn-primary:hover::before {
            transform: translateX(100%);
        }

        .btn-primary:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 
                0 12px 30px rgba(0, 212, 255, 0.4),
                0 0 40px rgba(0, 212, 255, 0.2);
            color: white;
        }

        .btn-primary:active {
            transform: translateY(0) scale(1);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-cyan);
            color: var(--primary-cyan);
            background: rgba(0, 212, 255, 0.05);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: var(--error-red);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.4);
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
            transform: translateX(-3px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .user-info {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

            .actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .profile-header,
            .profile-card {
                border-radius: 16px;
            }

            .form-group {
                margin-bottom: 16px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
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
