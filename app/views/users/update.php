<!DOCTYPE html>
<html>
<head>
    <title>Update Team Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { 
            margin: 0;
            padding: 0;
            box-sizing: border-box; 
        }
        
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; 
            color: #f1f5f9; 
            background: radial-gradient(ellipse at top, #1a1f35 0%, #0a0e1a 50%, #000 100%); 
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
                radial-gradient(circle at 30% 40%, rgba(245, 158, 11, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(239, 68, 68, 0.08) 0%, transparent 50%);
            pointer-events: none;
            animation: bgShift 10s ease-in-out infinite alternate;
        }

        @keyframes bgShift {
            to {
                background: 
                    radial-gradient(circle at 70% 60%, rgba(245, 158, 11, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 30% 40%, rgba(239, 68, 68, 0.08) 0%, transparent 50%);
            }
        }
        
        .container { 
            max-width: 520px; 
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
        
        .card { 
            background: linear-gradient(135deg, rgba(20, 27, 45, 0.95) 0%, rgba(20, 27, 45, 0.9) 100%); 
            border: 2px solid transparent; 
            border-radius: 20px; 
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                0 0 40px rgba(245, 158, 11, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.05); 
            overflow: hidden;
            backdrop-filter: blur(15px);
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 2px;
            background: linear-gradient(135deg, #f59e0b, #ef4444, #f59e0b);
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
        
        .card-header { 
            padding: clamp(20px, 5vw, 24px) clamp(20px, 5vw, 24px) clamp(14px, 3vw, 16px); 
            border-bottom: 2px solid transparent;
            border-image: linear-gradient(90deg, transparent, #f59e0b, transparent) 1; 
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.08) 0%, rgba(239, 68, 68, 0.08) 100%);
            position: relative;
        }

        .card-header::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #f59e0b, transparent);
            box-shadow: 0 0 10px #f59e0b;
        }
        
        .title { 
            margin: 0; 
            font-size: clamp(18px, 5vw, 24px); 
            font-family: 'Orbitron', monospace;
            background: linear-gradient(135deg, #f59e0b, #ef4444, #f59e0b);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700; 
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            to { background-position: 200% center; }
        }

        .title .icon {
            font-size: clamp(18px, 4vw, 20px);
        }
        
        .card-body { 
            padding: clamp(20px, 5vw, 24px);
            position: relative;
            z-index: 1;
        }
        
        .current-info { 
            background: rgba(245, 158, 11, 0.1); 
            border: 1px solid #f59e0b; 
            border-radius: 8px; 
            padding: 16px; 
            margin-bottom: 24px; 
            font-size: 14px; 
            color: #fbbf24; 
        }
        
        .form-group { 
            margin-bottom: 20px; 
        }
        
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #00d4ff; 
            text-transform: uppercase; 
            font-size: 12px; 
            letter-spacing: 0.5px; 
        }
        
        input[type="text"] { 
            width: 100%; 
            padding: clamp(10px, 2vw, 12px) clamp(14px, 3vw, 16px); 
            border: 2px solid #1e2738; 
            border-radius: 10px; 
            background: rgba(10, 14, 26, 0.8); 
            color: #f1f5f9; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            font-size: clamp(14px, 3vw, 16px); 
        }
        
        input[type="text"]:focus { 
            outline: none; 
            border-color: #f59e0b; 
            box-shadow: 
                0 0 0 3px rgba(245, 158, 11, 0.15),
                0 0 20px rgba(245, 158, 11, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.05); 
            background: rgba(10, 14, 26, 0.95);
            transform: translateY(-1px);
        }
        
        input[type="text"]::placeholder { 
            color: #64748b; 
        }
        
        .actions { 
            display: flex; 
            gap: 12px; 
            margin-top: 24px; 
        }
        
        .btn { 
            display: inline-block; 
            padding: 12px 24px; 
            text-decoration: none; 
            border-radius: 8px; 
            border: none; 
            font-size: 14px; 
            font-weight: 600; 
            text-transform: uppercase; 
            letter-spacing: 0.5px; 
            cursor: pointer; 
            transition: all 0.3s ease; 
            flex: 1;
            text-align: center;
        }
        
        .btn:active { 
            transform: translateY(1px); 
        }
        
        .btn-primary { 
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            color: white; 
            font-weight: 700;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
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
            background: linear-gradient(135deg, #d97706, #dc2626);
            transform: translateY(-2px) scale(1.02); 
            box-shadow: 
                0 12px 30px rgba(245, 158, 11, 0.4),
                0 0 40px rgba(245, 158, 11, 0.2); 
        }

        .btn-primary:active {
            transform: translateY(0) scale(1);
        }
        
        .btn-secondary { 
            background: transparent; 
            color: #94a3b8; 
            border: 2px solid #1e2738; 
        }
        
        .btn-secondary:hover { 
            border-color: #00d4ff; 
            color: #00d4ff;
            background: rgba(0, 212, 255, 0.05);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.1);
        }

        .icon {
            font-size: clamp(18px, 4vw, 20px);
        }

        @media (max-width: 768px) {
            .card {
                border-radius: 16px;
            }
        }

        @media (max-width: 480px) {
            .actions {
                flex-direction: column;
            }
            
            .card-body {
                padding: 18px;
            }
            
            .title {
                gap: 8px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .current-info {
                font-size: 13px;
                padding: 12px;
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
        <div class="card">
            <div class="card-header">
                <h1 class="title">
                    <span class="icon">⚙️</span>
                    Update Team Registration
                </h1>
            </div>
            <div class="card-body">
                <div class="current-info">
                    Currently editing: <strong><?= $signup['team_name'] ?></strong> • Captain: <strong><?= $signup['captain_name'] ?></strong>
                </div>
                
                <form action="<?= site_url('users/update/' . $signup['id']) ?>" method="POST">

                    <div class="form-group">
                        <label for="team_name">Team Name</label>
                        <input type="text" name="team_name" id="team_name" value="<?= $signup['team_name'] ?>" placeholder="Enter your team name" required>
                    </div>
                    <div class="form-group">
                        <label for="captain_name">Team Captain</label>
                        <input type="text" name="captain_name" id="captain_name" value="<?= $signup['captain_name'] ?>" placeholder="Captain's full name" required>
                    </div>
                    <div class="form-group">
                        <label for="game_title">Game Title</label>
                        <input type="text" name="game_title" id="game_title" value="<?= $signup['game_title'] ?>" placeholder="e.g. League of Legends, Valorant, CS:GO" required>
                    </div>
                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>