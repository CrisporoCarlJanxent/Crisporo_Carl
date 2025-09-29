<!DOCTYPE html>
<html>
<head>
    <title>Setup Admin Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #f1f5f9;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 800px;
        }
        .card {
            background: #1e293b;
            border: 2px solid #00d4ff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .message-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .message-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .table {
            background: #0f172a;
            color: #f1f5f9;
        }
        .table th {
            background: #1e293b;
            color: #00d4ff;
            border-color: #334155;
        }
        .table td {
            border-color: #334155;
        }
        .btn {
            background: linear-gradient(135deg, #00d4ff, #8b5cf6);
            border: none;
            color: white;
            font-weight: 600;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 212, 255, 0.3);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <h1 class="text-center mb-4">
                <i class="fas fa-cog"></i> Setup Admin Account
            </h1>
            
            <?php foreach ($messages as $message): ?>
                <div class="message-<?= $message['type'] ?>">
                    <i class="fas fa-<?= $message['type'] === 'success' ? 'check-circle' : 'exclamation-triangle' ?>"></i>
                    <?= htmlspecialchars($message['text']) ?>
                </div>
            <?php endforeach; ?>
            
            <?php if (!empty($users)): ?>
                <h3 class="mt-4">Current Users in Database:</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['id']) ?></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : 'success' ?>">
                                            <?= strtoupper($user['role']) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($user['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            
            <div class="mt-4 p-3" style="background: rgba(0, 212, 255, 0.1); border-radius: 8px;">
                <h4><i class="fas fa-key"></i> Admin Login Credentials:</h4>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Admin Account 1:</h5>
                        <p><strong>Username:</strong> admin</p>
                        <p><strong>Password:</strong> admin123</p>
                        <p><strong>Email:</strong> admin@tournament.com</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Admin Account 2:</h5>
                        <p><strong>Username:</strong> ADMIN</p>
                        <p><strong>Password:</strong> ADMIN</p>
                        <p><strong>Email:</strong> admin2@tournament.com</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="<?= site_url('auth/login') ?>" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Go to Login
                </a>
                <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Go to App
                </a>
            </div>
        </div>
    </div>
</body>
</html>
