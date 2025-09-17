<!DOCTYPE html>
<html>
<head>
    <title>Tournament Signup</title>
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
            max-width: 500px; 
            width: 100%; 
        }
        
        .card { 
            background: #1e293b; 
            border: 1px solid #334155; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); 
            overflow: hidden;
        }
        
        .card-header { 
            padding: 24px 24px 16px; 
            border-bottom: 1px solid #334155; 
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%); 
        }
        
        .title { 
            margin: 0; 
            font-size: 24px; 
            color: #00d4ff; 
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
            border-color: #00d4ff; 
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1); 
            background: #0f172a; 
        }
        
        input[type="text"]::placeholder { 
            color: #64748b; 
        }

        input[type="file"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px dashed #334155;
            border-radius: 8px;
            background: #0f172a;
            color: #f1f5f9;
            transition: all 0.3s ease;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="file"]:hover {
            border-color: #00d4ff;
            background: rgba(0, 212, 255, 0.05);
        }

        input[type="file"]::file-selector-button {
            padding: 8px 16px;
            margin-right: 16px;
            border: none;
            border-radius: 6px;
            background: linear-gradient(135deg, #00d4ff 0%, #8b5cf6 100%);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="file"]::file-selector-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 212, 255, 0.2);
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
            background: linear-gradient(135deg, #00d4ff 0%, #8b5cf6 100%); 
            color: white; 
        }
        
        .btn-primary:hover { 
            transform: translateY(-1px); 
            box-shadow: 0 8px 20px rgba(0, 212, 255, 0.3); 
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
                    <span class="icon">🎮</span>
                    Tournament Registration
                    <span class="icon">🏆</span>
                </h1>
            </div>
            <div class="card-body">
                <form action="<?= site_url('users/create') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="team_logo">Team Logo</label>
                        <input type="file" name="team_logo" id="team_logo" accept="image/*" required class="form-control" style="background: #0f172a; color: #f1f5f9; border: 2px solid #334155; padding: 8px;">
                        <small style="display: block; margin-top: 4px; color: #94a3b8;">Accepted formats: JPG, JPEG, PNG, GIF (Max: 2MB)</small>
                    </div>
                    <div class="form-group">
                        <label for="team_name">Team Name</label>
                        <input type="text" name="team_name" id="team_name" placeholder="Enter your team name" required>
                    </div>
                    <div class="form-group">
                        <label for="captain_name">Team Captain</label>
                        <input type="text" name="captain_name" id="captain_name" placeholder="Captain's full name" required>
                    </div>
                    <div class="form-group">
                        <label for="game_title">Game Title</label>
                        <input type="text" name="game_title" id="game_title" placeholder="e.g. League of Legends, Valorant, CS:GO" required>
                    </div>
                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Register Team</button>
                        <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>