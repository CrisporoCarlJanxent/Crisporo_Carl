<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gaming Tournament</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* Gaming Theme Variables */
        :root {
            --primary-cyan: #00d4ff;
            --secondary-purple: #8b5cf6;
            --accent-green: #10b981;
            --accent-orange: #f59e0b;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --border-color: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1e293b 100%);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            padding: 20px;
        }

        /* Header */
        .dashboard-header {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--primary-cyan) 0%, transparent 70%);
            opacity: 0.1;
        }

        .welcome-title {
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: 2.5rem;
            color: var(--primary-cyan);
            text-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            margin-bottom: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            color: white;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .user-email {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .role-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 5px;
        }

        .role-admin {
            background: linear-gradient(135deg, var(--accent-orange), #ef4444);
            color: white;
        }

        .role-user {
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple));
            color: white;
        }

        /* Quick Actions Grid */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-card {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-cyan), var(--secondary-purple));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-cyan);
            box-shadow: 0 15px 40px rgba(0, 212, 255, 0.3);
        }

        .action-card:hover::before {
            transform: scaleX(1);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .icon-cyan {
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.2), rgba(0, 212, 255, 0.1));
            color: var(--primary-cyan);
        }

        .icon-purple {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(139, 92, 246, 0.1));
            color: var(--secondary-purple);
        }

        .icon-green {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.1));
            color: var(--accent-green);
        }

        .icon-orange {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(245, 158, 11, 0.1));
            color: var(--accent-orange);
        }

        .action-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .action-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Stats Section */
        .stats-section {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .stats-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.3rem;
            color: var(--primary-cyan);
            margin-bottom: 20px;
        }

        /* Logout Button */
        .logout-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 1.8rem;
            }

            .user-info {
                flex-direction: column;
                text-align: center;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="welcome-title">
                <i class="fas fa-gamepad"></i> Gaming Tournament Dashboard
            </div>
            <p style="color: var(--text-secondary); font-size: 1.1rem;">Welcome back, champion! 🎮</p>

            <div class="user-info">
                <div class="user-avatar">
                    <?= strtoupper(substr($username, 0, 1)) ?>
                </div>
                <div class="user-details">
                    <div class="user-name"><?= htmlspecialchars($username) ?></div>
                    <div class="user-email">
                        <i class="fas fa-envelope"></i> <?= htmlspecialchars($email) ?>
                    </div>
                    <span class="role-badge <?= $role === 'admin' ? 'role-admin' : 'role-user' ?>">
                        <i class="fas fa-<?= $role === 'admin' ? 'crown' : 'user' ?>"></i>
                        <?= strtoupper($role) ?>
                    </span>
                </div>
                <div>
                    <a href="<?= site_url('auth/logout') ?>" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="<?= site_url('users/view') ?>" class="action-card">
                <div class="action-icon icon-cyan">
                    <i class="fas fa-users"></i>
                </div>
                <div class="action-title">View Teams</div>
                <div class="action-description">Browse all registered tournament teams and their details</div>
            </a>

            <a href="<?= site_url('users/create') ?>" class="action-card">
                <div class="action-icon icon-purple">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="action-title">Register New Team</div>
                <div class="action-description">Add a new team to the tournament roster</div>
            </a>

            <a href="<?= site_url('auth/profile') ?>" class="action-card">
                <div class="action-icon icon-green">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="action-title">My Profile</div>
                <div class="action-description">View and update your personal profile information</div>
            </a>

            <a href="<?= site_url('auth/change_password') ?>" class="action-card">
                <div class="action-icon icon-orange">
                    <i class="fas fa-key"></i>
                </div>
                <div class="action-title">Change Password</div>
                <div class="action-description">Update your account security credentials</div>
            </a>
        </div>

        <!-- Quick Info -->
        <div class="stats-section">
            <div class="stats-title">
                <i class="fas fa-info-circle"></i> Quick Info
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div style="color: var(--text-secondary);">Account Status</div>
                    <div style="color: var(--accent-green); font-weight: 600; font-size: 1.2rem;">
                        <i class="fas fa-check-circle"></i> Active
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div style="color: var(--text-secondary);">Access Level</div>
                    <div style="color: var(--primary-cyan); font-weight: 600; font-size: 1.2rem;">
                        <?= $role === 'admin' ? 'Administrator' : 'User' ?>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div style="color: var(--text-secondary);">Session Status</div>
                    <div style="color: var(--accent-green); font-weight: 600; font-size: 1.2rem;">
                        <i class="fas fa-shield-alt"></i> Secure
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
