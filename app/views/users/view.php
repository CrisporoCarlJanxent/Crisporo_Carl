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
        }

        /* Main Container */
        .main-container {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Title */
        .main-title {
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: 2rem;
            color: var(--primary-cyan);
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        /* Search Input */
        .search-input {
            background: var(--dark-bg);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary-cyan);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
            background: var(--dark-bg);
            color: var(--text-primary);
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
            padding: 12px 24px;
            transition: all 0.3s ease;
        }

        .btn-gaming:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 212, 255, 0.3);
            color: white;
        }

        .btn-secondary-gaming {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-secondary);
            font-weight: 600;
            border-radius: 12px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-secondary-gaming:hover {
            border-color: var(--primary-cyan);
            color: var(--primary-cyan);
        }

        /* Table */
        .gaming-table {
            background: var(--dark-bg);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .gaming-table th {
            background: var(--card-bg);
            color: var(--primary-cyan);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--primary-cyan);
            padding: 16px 12px;
        }

        .gaming-table td {
            background: var(--dark-bg);
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 12px;
            transition: background 0.2s ease;
        }

        .gaming-table tbody tr:hover {
            background: rgba(0, 212, 255, 0.05);
        }

        /* Action Buttons */
        .btn-edit {
            background: var(--accent-green);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-edit:hover {
            background: #059669;
            color: white;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
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
            .main-title {
                font-size: 1.5rem;
            }
            
            .gaming-table {
                font-size: 0.9rem;
            }
            
            .gaming-table th,
            .gaming-table td {
                padding: 12px 8px;
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

        <!-- Search + Add/Back -->
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
                                       class="btn btn-sm btn-edit me-2">
                                        <i class="fas fa-edit"></i> EDIT
                                    </a>
                                    <a href="<?= site_url('users/delete/'.$signup['id']); ?>" 
                                       class="btn btn-sm btn-delete">
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