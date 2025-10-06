<!DOCTYPE html>
<html>
<head>
    <title>Team Signups - Gaming Tournament</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* Gaming Theme Variables */
        :root {
            --primary-cyan: #00d4ff;
            --secondary-purple: #8b5cf6;
            --accent-green: #10b981;
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

        /* Main Container */
        .container {
            position: relative;
            z-index: 1;
            padding: clamp(15px, 3vw, 20px);
        }

        .main-container {
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.95) 0%, rgba(20, 27, 45, 0.8) 100%);
            border: 2px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
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

        /* Title */
        .main-title {
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: clamp(1.3rem, 4vw, 2rem);
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple), var(--primary-cyan));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            to { background-position: 200% center; }
        }

        .main-title i {
            -webkit-text-fill-color: var(--primary-cyan);
            filter: drop-shadow(0 0 10px rgba(0, 212, 255, 0.5));
        }

        /* Search Input */
        .search-input {
            background: rgba(10, 14, 26, 0.8);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 12px;
            padding: clamp(10px, 2vw, 12px) clamp(14px, 3vw, 16px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: clamp(14px, 2.5vw, 16px);
        }

        .search-input:focus {
            border-color: var(--primary-cyan);
            box-shadow: 
                0 0 0 3px rgba(0, 212, 255, 0.15),
                0 0 20px rgba(0, 212, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            background: rgba(10, 14, 26, 0.95);
            color: var(--text-primary);
            transform: translateY(-1px);
        }

        .search-input::placeholder {
            color: var(--text-secondary);
        }

        /* Buttons */
        .btn-gaming {
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple));
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            padding: clamp(10px, 2vw, 12px) clamp(18px, 3vw, 24px);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: clamp(13px, 2.5vw, 15px);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        }

        .btn-gaming::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .btn-gaming:hover::before {
            transform: translateX(100%);
        }

        .btn-gaming:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 212, 255, 0.4);
            color: white;
        }

        .btn-secondary-gaming {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-secondary);
            font-weight: 600;
            border-radius: 12px;
            padding: clamp(8px, 1.8vw, 10px) clamp(16px, 2.8vw, 20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: clamp(13px, 2.5vw, 14px);
        }

        .btn-secondary-gaming:hover {
            border-color: var(--primary-cyan);
            color: var(--primary-cyan);
            background: rgba(0, 212, 255, 0.05);
            transform: translateY(-1px);
        }

        /* Table */
        .gaming-table {
            background: rgba(10, 14, 26, 0.6);
            border-radius: 12px;
            overflow-x: auto;
            overflow-y: hidden;
            border: 2px solid var(--border-color);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.03);
        }

        .gaming-table th {
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.8) 0%, rgba(20, 27, 45, 0.6) 100%);
            color: var(--primary-cyan);
            font-weight: 600;
            text-transform: uppercase;
            font-size: clamp(0.75rem, 2vw, 0.9rem);
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--primary-cyan);
            padding: clamp(12px, 2.5vw, 16px) clamp(8px, 2vw, 12px);
            white-space: nowrap;
        }

        .gaming-table td {
            background: rgba(10, 14, 26, 0.4);
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
            padding: clamp(12px, 2.5vw, 16px) clamp(8px, 2vw, 12px);
            transition: all 0.3s ease;
            font-size: clamp(0.85rem, 2vw, 0.95rem);
        }

        .gaming-table tbody tr {
            transition: all 0.3s ease;
        }

        .gaming-table tbody tr:hover {
            background: rgba(0, 212, 255, 0.08);
            transform: scale(1.01);
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.1);
        }

        .gaming-table tbody tr:hover td {
            background: transparent;
        }

        /* Team Logo Styling - FIXED */
        .team-logo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
            display: block;
        }

        .team-logo:hover {
            border-color: var(--primary-cyan);
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
        }

        .logo-placeholder {
            width: 50px;
            height: 50px;
            background: var(--card-bg);
            border-radius: 10px;
            border: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .logo-placeholder:hover {
            border-color: var(--primary-cyan);
            background: rgba(0, 212, 255, 0.1);
        }

        /* Action Buttons */
        .btn-edit {
            background: linear-gradient(135deg, var(--accent-green), #059669);
            color: white;
            border: none;
            border-radius: 8px;
            padding: clamp(5px, 1.2vw, 6px) clamp(10px, 2vw, 12px);
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border: none;
            border-radius: 8px;
            padding: clamp(5px, 1.2vw, 6px) clamp(10px, 2vw, 12px);
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        /* Pagination */
        .pagination-gaming .page-item .page-link {
            background: var(--dark-bg);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 8px;
            margin: 0 2px;
            padding: 10px 14px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .pagination-gaming .page-item .page-link:hover {
            background: var(--primary-cyan);
            border-color: var(--primary-cyan);
            color: white;
        }

        .pagination-gaming .page-item.active .page-link {
            background: var(--primary-cyan);
            border-color: var(--primary-cyan);
            color: white;
        }

        .pagination-gaming .page-item.disabled .page-link {
            background: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-secondary);
            opacity: 0.5;
        }

        /* No Results */
        .no-results {
            color: var(--text-secondary);
            font-size: 1.1rem;
            text-align: center;
            padding: 40px 20px;
        }

        /* Gaming Icons */
        .gaming-icon {
            color: var(--primary-cyan);
            margin-right: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .user-info {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .user-info .btn {
                width: 100%;
                justify-content: center;
            }

            .search-container {
                width: 100%;
            }

            .input-group {
                width: 100%;
            }

            .gaming-table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .team-logo,
            .logo-placeholder {
                width: 35px;
                height: 35px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0;
            }

            .container {
                padding: 10px;
            }

            .main-container {
                border-radius: 16px;
            }

            .mb-4 {
                margin-bottom: 15px !important;
            }

            .btn-edit,
            .btn-delete {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            .btn-edit i,
            .btn-delete i {
                display: none;
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

<div class="container mt-5">
    <div class="main-container shadow-lg p-4">
        <h2 class="main-title mb-4 text-center">
            <i class="fas fa-gamepad gaming-icon"></i>
            TOURNAMENT TEAM SIGNUPS
            <i class="fas fa-trophy gaming-icon"></i>
        </h2>

        <!-- User Info + Search + Add/Back -->
        <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <!-- Navigation -->
            <div class="user-info d-flex align-items-center gap-2">
                <a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-secondary-gaming">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="<?= site_url('auth/profile') ?>" class="btn btn-sm btn-secondary-gaming">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="<?= site_url('auth/logout') ?>" class="btn btn-sm btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <form method="get" action="<?= site_url('users/view'); ?>" class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="search-container d-flex align-items-center">
                <div class="input-group">
                    <input type="text" name="q" 
                           class="form-control search-input" 
                           placeholder="🔍 Search teams..."
                           value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                    <button class="btn btn-gaming" type="submit">
                        <i class="fas fa-search"></i> SEARCH
                    </button>
                </div>
            </div>

            <!-- Right Side Button -->
            <?php if (!empty($_GET['q'])): ?>
                <!-- Back when searching -->
                <a href="<?= site_url('users/view'); ?>" class="btn btn-secondary-gaming">
                    <i class="fas fa-arrow-left"></i> BACK TO ALL TEAMS
                </a>
            <?php else: ?>
                <!-- Add Team by default -->
                <a href="<?= site_url('users/create'); ?>" class="btn btn-gaming">
                    <i class="fas fa-plus"></i> ADD TEAM
                </a>
            <?php endif; ?>
        </form>

        <!-- Gaming Table -->
        <div class="table-responsive">
            <table class="table gaming-table text-center align-middle">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-users"></i> Team Name</th>
                        <th><i class="fas fa-crown"></i> Captain</th>
                        <th><i class="fas fa-gamepad"></i> Game Title</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($signups)): ?>
                        <?php foreach ($signups as $signup): ?>
                            <tr>
                                <td><span class="badge bg-primary"><?= $signup['id']; ?></span></td>
                                <td><strong><?= htmlspecialchars($signup['team_name']); ?></strong></td>
                                <td><?= htmlspecialchars($signup['captain_name']); ?></td>
                                <td><em><?= htmlspecialchars($signup['game_title']); ?></em></td>
                                <td>
                                    <a href="<?= site_url('users/update/'.$signup['id']); ?>" 
                                       class="btn btn-sm btn-edit me-2" 
                                       title="Edit team">
                                        <i class="fas fa-edit"></i> EDIT
                                    </a>
                                    <a href="<?= site_url('users/delete/'.$signup['id']); ?>" 
                                       class="btn btn-sm btn-delete"
                                       title="Delete team"
                                       onclick="return confirm('Are you sure you want to delete this team?');">
                                        <i class="fas fa-trash-alt"></i> DELETE
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="no-results">
                                <i class="fas fa-search gaming-icon"></i>
                                No teams found. Ready to dominate? Create the first team!
                                <i class="fas fa-rocket gaming-icon"></i>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Gaming Pagination -->
        <?php if (!empty($page)): ?>
            <nav class="mt-4">
                <ul class="pagination pagination-gaming justify-content-center">
                    <?= $page; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hover effects for buttons
        const buttons = document.querySelectorAll('.btn-gaming, .btn-edit, .btn-delete');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Table row hover effects
        const tableRows = document.querySelectorAll('.gaming-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.borderLeft = '3px solid #00d4ff';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.borderLeft = 'none';
            });
        });
    });
</script>

</body>
</html>