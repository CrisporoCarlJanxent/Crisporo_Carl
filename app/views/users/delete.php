<!DOCTYPE html>
<html>
<head>
    <title>Remove Team Registration</title>
    <style>
        * { 
            box-sizing: border-box; 
        }
        
        body { 
            margin: 0; 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; 
            color: #f1f5f9; 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
            min-height: 100vh; 
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container { 
            max-width: 480px; 
            width: 100%; 
        }
        
        .card { 
            background: #1e293b; 
            border: 2px solid #ef4444; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 20px rgba(239, 68, 68, 0.1); 
            overflow: hidden;
        }
        
        .card-header { 
            padding: 24px 24px 16px; 
            border-bottom: 1px solid #ef4444; 
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(220, 38, 38, 0.05) 100%); 
        }
        
        .title { 
            margin: 0; 
            font-size: 20px; 
            color: #ef4444; 
            font-weight: 700; 
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-body { 
            padding: 24px; 
            text-align: center; 
        }
        
        .warning-icon { 
            font-size: 48px; 
            margin-bottom: 16px; 
        }
        
        p { 
            color: #cbd5e1; 
            font-size: 16px; 
            line-height: 1.6; 
            margin-bottom: 20px; 
        }
        
        .team-info { 
            background: rgba(239, 68, 68, 0.1); 
            border: 1px solid #ef4444; 
            border-radius: 12px; 
            padding: 20px; 
            margin: 20px 0; 
            text-align: left;
        }
        
        .info-row {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-row:last-child {
            margin-bottom: 0;
        }
        
        .info-label {
            font-weight: 600;
            color: #94a3b8;
            min-width: 80px;
        }
        
        .team-name { 
            color: #fbbf24; 
            font-weight: 700; 
        }
        
        .captain-name { 
            color: #a78bfa; 
            font-weight: 600; 
        }
        
        .game-title { 
            color: #10b981; 
            font-weight: 600; 
        }
        
        .warning-text {
            color: #ef4444; 
            font-weight: 600;
            font-size: 14px;
        }
        
        .actions { 
            display: flex; 
            justify-content: center; 
            gap: 16px; 
            margin-top: 24px; 
        }
        
        .btn { 
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
            max-width: 140px;
        }
        
        .btn:active { 
            transform: translateY(1px); 
        }
        
        .btn-confirm { 
            background: #ef4444; 
            color: white; 
        }
        
        .btn-confirm:hover { 
            background: #dc2626; 
            transform: translateY(-1px); 
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3); 
        }
        
        .btn-cancel { 
            background: transparent; 
            color: #94a3b8; 
            border: 2px solid #334155; 
        }
        
        .btn-cancel:hover { 
            border-color: #00d4ff; 
            color: #00d4ff; 
        }

        @media (max-width: 480px) {
            .actions {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                max-width: none;
                width: 100%;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }
            
            .info-label {
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="title">Remove Team Registration</h1>
            </div>
            <div class="card-body">
                <div class="warning-icon">🛑</div>
                <p>Are you sure you want to <strong>permanently remove</strong> this team from the tournament?</p>
                
                <div class="team-info">
                    <div class="info-row">
                        <span class="info-label">Team:</span>
                        <span class="team-name"><?= $signup['team_name'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Captain:</span>
                        <span class="captain-name"><?= $signup['captain_name'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Game:</span>
                        <span class="game-title"><?= $signup['game_title'] ?></span>
                    </div>
                </div>
                
                <p class="warning-text">⚡ This action cannot be undone!</p>
                
                <form action="<?= site_url('users/delete/' . $signup['id']) ?>" method="POST">
                    <div class="actions">
                        <button type="submit" class="btn btn-confirm">Remove Team</button>
                        <a href="<?= site_url('users/view') ?>" class="btn btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>