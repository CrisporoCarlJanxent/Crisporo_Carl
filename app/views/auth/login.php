<!DOCTYPE html>
<html>
<head>
    <title>Login - Tournament Management</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
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
                radial-gradient(circle at 30% 40%, rgba(0, 212, 255, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(139, 92, 246, 0.08) 0%, transparent 50%);
            pointer-events: none;
            animation: bgShift 10s ease-in-out infinite alternate;
        }

        @keyframes bgShift {
            to {
                background: 
                    radial-gradient(circle at 70% 60%, rgba(0, 212, 255, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 30% 40%, rgba(139, 92, 246, 0.08) 0%, transparent 50%);
            }
        }

        .auth-container {
            max-width: 400px;
            width: 100%;
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

        .auth-card {
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.95) 0%, rgba(20, 27, 45, 0.9) 100%);
            border: 2px solid transparent;
            border-radius: 20px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                0 0 40px rgba(0, 212, 255, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            overflow: hidden;
            backdrop-filter: blur(15px);
            position: relative;
        }

        .auth-card::before {
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

        .auth-header {
            padding: clamp(20px, 5vw, 24px) clamp(20px, 5vw, 24px) clamp(14px, 3vw, 16px);
            border-bottom: 2px solid transparent;
            border-image: linear-gradient(90deg, transparent, var(--primary-cyan), transparent) 1;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
            text-align: center;
            position: relative;
        }

        .auth-header::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-cyan), transparent);
            box-shadow: 0 0 10px var(--primary-cyan);
        }

        .auth-title {
            margin: 0;
            font-family: 'Orbitron', monospace;
            font-size: clamp(20px, 5vw, 28px);
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple), var(--primary-cyan));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            text-shadow: 0 0 20px rgba(0, 212, 255, 0.4);
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            to { background-position: 200% center; }
        }

        .auth-title i {
            -webkit-text-fill-color: var(--primary-cyan);
            filter: drop-shadow(0 0 10px rgba(0, 212, 255, 0.6));
        }

        .auth-body {
            padding: clamp(20px, 5vw, 24px);
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
            position: relative;
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

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple));
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: clamp(10px, 2.5vw, 14px) clamp(20px, 4vw, 24px);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: clamp(14px, 3vw, 16px);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .btn-login:hover::before {
            transform: translateX(100%);
        }

        .btn-login:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 
                0 12px 30px rgba(0, 212, 255, 0.4),
                0 0 40px rgba(0, 212, 255, 0.2);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0) scale(1);
        }

        .btn-register {
            width: 100%;
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-secondary);
            font-weight: 600;
            border-radius: 10px;
            padding: clamp(8px, 2vw, 10px) clamp(20px, 4vw, 24px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: clamp(14px, 3vw, 16px);
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-register:hover {
            border-color: var(--primary-cyan);
            color: var(--primary-cyan);
            background: rgba(0, 212, 255, 0.05);
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.1);
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

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .auth-footer a {
            color: var(--primary-cyan);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .gaming-icon {
            color: var(--primary-cyan);
            margin-right: 8px;
            animation: iconFloat 3s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .auth-card {
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
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1 class="auth-title">
                    <i class="fas fa-gamepad gaming-icon"></i>
                    LOGIN
                </h1>
            </div>
            <div class="auth-body">
                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('auth/login') ?>" method="POST">
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i> Username or Email
                        </label>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control" 
                               placeholder="Enter your username or email"
                               value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control" 
                               placeholder="Enter your password"
                               required>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> LOGIN
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Don't have an account? <a href="<?= site_url('auth/register') ?>">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
