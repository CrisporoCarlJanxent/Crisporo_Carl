<!DOCTYPE html>
<html>
<head>
    <title>Register - Tournament Management</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            max-width: 450px;
            width: 100%;
        }

        .auth-card {
            background: var(--card-bg);
            border: 2px solid var(--accent-green);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 20px rgba(16, 185, 129, 0.1);
            overflow: hidden;
        }

        .auth-header {
            padding: 24px 24px 16px;
            border-bottom: 1px solid var(--accent-green);
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(0, 212, 255, 0.05) 100%);
            text-align: center;
        }

        .auth-title {
            margin: 0;
            font-family: 'Orbitron', monospace;
            font-size: 24px;
            color: var(--accent-green);
            font-weight: 700;
            text-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }

        .auth-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--accent-green);
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
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            background: var(--dark-bg);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, var(--accent-green), var(--primary-cyan));
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px 24px;
            transition: all 0.3s ease;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .btn-login {
            width: 100%;
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-secondary);
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 24px;
            transition: all 0.3s ease;
            font-size: 16px;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-login:hover {
            border-color: var(--accent-green);
            color: var(--accent-green);
            text-decoration: none;
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
            color: var(--accent-green);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .gaming-icon {
            color: var(--accent-green);
            margin-right: 8px;
        }

        .password-requirements {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1 class="auth-title">
                    <i class="fas fa-user-plus gaming-icon"></i>
                    REGISTER
                </h1>
            </div>
            <div class="auth-body">
                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('auth/register') ?>" method="POST">
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control" 
                               placeholder="Choose a username"
                               value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control" 
                               placeholder="Enter your email address"
                               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
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
                               placeholder="Create a password"
                               required>
                        <div class="password-requirements">
                            Minimum 6 characters
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password" class="form-label">
                            <i class="fas fa-lock"></i> Confirm Password
                        </label>
                        <input type="password" 
                               name="confirm_password" 
                               id="confirm_password" 
                               class="form-control" 
                               placeholder="Confirm your password"
                               required>
                    </div>

                    <button type="submit" class="btn-register">
                        <i class="fas fa-user-plus"></i> REGISTER
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Already have an account? <a href="<?= site_url('auth/login') ?>">Login here</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password confirmation validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (password !== confirmPassword) {
                this.style.borderColor = '#ef4444';
            } else {
                this.style.borderColor = '#10b981';
            }
        });
    </script>
</body>
</html>
