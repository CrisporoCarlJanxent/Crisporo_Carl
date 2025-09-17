<!DOCTYPE html>
<html>
<head>
    <title>Update Team Registration</title>
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
            max-width: 520px; 
            width: 100%; 
        }
        
        .card { 
            background: #1e293b; 
            border: 2px solid #f59e0b; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 20px rgba(245, 158, 11, 0.1); 
            overflow: hidden;
        }
        
        .card-header { 
            padding: 24px 24px 16px; 
            border-bottom: 1px solid #f59e0b; 
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(217, 119, 6, 0.05) 100%); 
        }
        
        .title { 
            margin: 0; 
            font-size: 24px; 
            color: #f59e0b; 
            font-weight: 700; 
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        
        .card-body { 
            padding: 24px; 
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
            padding: 12px 16px; 
            border: 2px solid #334155; 
            border-radius: 8px; 
            background: #0f172a; 
            color: #f1f5f9; 
            transition: all 0.3s ease; 
            font-size: 16px; 
        }
        
        input[type="text"]:focus { 
            outline: none; 
            border-color: #f59e0b; 
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1); 
            background: #0f172a; 
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
            background: #f59e0b; 
            color: #0f172a; 
            font-weight: 700;
        }
        
        .btn-primary:hover { 
            background: #d97706; 
            transform: translateY(-1px); 
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3); 
        }
        
        .btn-secondary { 
            background: transparent; 
            color: #94a3b8; 
            border: 2px solid #334155; 
        }
        
        .btn-secondary:hover { 
            border-color: #00d4ff; 
            color: #00d4ff; 
        }

        .icon {
            font-size: 20px;
        }

        @media (max-width: 480px) {
            .actions {
                flex-direction: column;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .title {
                font-size: 20px;
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
                
                <form action="<?= site_url('users/update/' . $signup['id']) ?>" method="POST" enctype="multipart/form-data">
                    <?php if(isset($signup['team_logo']) && !empty($signup['team_logo'])): ?>
                    <div class="form-group">
                        <label>Current Logo</label>
                        <div style="margin: 10px 0; text-align: center;">
                            <img src="<?= base_url($signup['team_logo']) ?>" alt="Team Logo" style="max-width: 150px; max-height: 150px; border-radius: 8px; border: 2px solid #334155;">
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="team_logo">Update Team Logo</label>
                        <input type="file" name="team_logo" id="team_logo" accept="image/*" class="form-control" style="background: #0f172a; color: #f1f5f9; border: 2px solid #334155; padding: 8px;">
                        <small style="display: block; margin-top: 4px; color: #94a3b8;">Leave empty to keep current logo. Accepted formats: JPG, JPEG, PNG, GIF (Max: 2MB)</small>
                    </div>

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