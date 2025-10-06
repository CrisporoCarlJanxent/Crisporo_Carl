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
            --dark-bg: #0a0e1a;
            --card-bg: #141b2d;
            --border-color: #1e2738;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
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
            padding: 15px;
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
            position: relative;
            z-index: 1;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .dashboard-header {
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.95) 0%, rgba(20, 27, 45, 0.8) 100%);
            border: 2px solid transparent;
            border-radius: 20px;
            padding: clamp(20px, 4vw, 35px);
            margin-bottom: clamp(20px, 3vw, 30px);
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, var(--primary-cyan) 0%, transparent 70%);
            opacity: 0.08;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.08; transform: scale(1); }
            50% { opacity: 0.12; transform: scale(1.1); }
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 2px;
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple), var(--accent-green));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0.3;
        }

        .welcome-title {
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: clamp(1.5rem, 5vw, 2.5rem);
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple), var(--primary-cyan));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(0, 212, 255, 0.3);
            margin-bottom: 10px;
            animation: shimmer 3s linear infinite;
            position: relative;
        }

        @keyframes shimmer {
            to { background-position: 200% center; }
        }

        .welcome-title i {
            -webkit-text-fill-color: var(--primary-cyan);
            filter: drop-shadow(0 0 10px rgba(0, 212, 255, 0.5));
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: clamp(12px, 2vw, 20px);
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .user-avatar {
            width: clamp(60px, 12vw, 80px);
            height: clamp(60px, 12vw, 80px);
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: bold;
            color: white;
            box-shadow: 
                0 0 30px rgba(0, 212, 255, 0.5),
                inset 0 2px 5px rgba(255, 255, 255, 0.2);
            position: relative;
            animation: avatarGlow 2s ease-in-out infinite;
        }

        @keyframes avatarGlow {
            0%, 100% { box-shadow: 0 0 30px rgba(0, 212, 255, 0.5), inset 0 2px 5px rgba(255, 255, 255, 0.2); }
            50% { box-shadow: 0 0 40px rgba(139, 92, 246, 0.6), inset 0 2px 5px rgba(255, 255, 255, 0.3); }
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-size: clamp(1.1rem, 3vw, 1.5rem);
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 250px), 1fr));
            gap: clamp(15px, 2.5vw, 20px);
            margin-bottom: clamp(20px, 3vw, 30px);
        }

        .action-card {
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.6) 0%, rgba(20, 27, 45, 0.4) 100%);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: clamp(20px, 4vw, 25px);
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            animation: cardFadeIn 0.6s ease-out backwards;
        }

        .action-card:nth-child(1) { animation-delay: 0.1s; }
        .action-card:nth-child(2) { animation-delay: 0.2s; }
        .action-card:nth-child(3) { animation-delay: 0.3s; }
        .action-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .action-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(0, 212, 255, 0.1) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: var(--primary-cyan);
            box-shadow: 
                0 20px 60px rgba(0, 212, 255, 0.3),
                0 0 0 1px rgba(0, 212, 255, 0.2);
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.8) 0%, rgba(20, 27, 45, 0.6) 100%);
        }

        .action-card:hover::before {
            transform: scaleX(1);
        }

        .action-card:hover::after {
            opacity: 1;
        }

        .action-card:active {
            transform: translateY(-5px) scale(1);
        }

        .action-icon {
            width: clamp(50px, 10vw, 60px);
            height: clamp(50px, 10vw, 60px);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1.5rem, 3vw, 1.8rem);
            margin-bottom: 15px;
            transition: all 0.3s ease;
            position: relative;
        }

        .action-card:hover .action-icon {
            transform: scale(1.1) rotate(5deg);
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
            font-size: clamp(1rem, 2.5vw, 1.1rem);
            color: var(--text-primary);
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .action-card:hover .action-title {
            color: var(--primary-cyan);
        }

        .action-description {
            color: var(--text-secondary);
            font-size: clamp(0.85rem, 2vw, 0.9rem);
            line-height: 1.6;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.6) 0%, rgba(20, 27, 45, 0.4) 100%);
            border: 2px solid var(--border-color);
            border-radius: 20px;
            padding: clamp(20px, 4vw, 30px);
            margin-bottom: clamp(20px, 3vw, 30px);
            backdrop-filter: blur(10px);
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            animation: cardFadeIn 0.6s ease-out 0.5s backwards;
        }

        .stats-title {
            font-family: 'Orbitron', monospace;
            font-size: clamp(1.1rem, 3vw, 1.3rem);
            color: var(--primary-cyan);
            margin-bottom: 20px;
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        /* Logout Button */
        .logout-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
            color: white;
            padding: clamp(10px, 2vw, 12px) clamp(20px, 4vw, 30px);
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: clamp(0.85rem, 2vw, 0.95rem);
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .logout-btn:hover::before {
            transform: translateX(100%);
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.4);
            color: white;
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .dashboard-header {
                border-radius: 16px;
            }

            .user-info {
                justify-content: center;
                text-align: center;
            }

            .user-details {
                flex: 1;
                text-align: center;
            }

            .logout-btn {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
            }
        }

        @media (max-width: 480px) {
            .user-info {
                flex-direction: column;
            }

            .action-card {
                border-radius: 12px;
            }

            .stats-section .col-md-4 {
                margin-bottom: 15px !important;
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
