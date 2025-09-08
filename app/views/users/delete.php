<!DOCTYPE html>
<html>
<head>
    <title>Remove Team Registration</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Arial', sans-serif; color: #e0e0e0; background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%); min-height: 100vh; }
        .bg-decor { position: fixed; inset: 0; z-index: -1; pointer-events: none; background:
            radial-gradient(600px 600px at 0% 0%, rgba(255,0,0,.08), transparent 60%),
            radial-gradient(600px 600px at 100% 0%, rgba(255,69,0,.06), transparent 60%),
            radial-gradient(600px 600px at 0% 100%, rgba(220,20,60,.05), transparent 60%),
            radial-gradient(600px 600px at 100% 100%, rgba(255,20,147,.07), transparent 60%);
            animation: floatBg 20s ease-in-out infinite alternate; }
        .container { max-width: 560px; margin: 80px auto; padding: 0 16px; }
        .card { background: linear-gradient(145deg, #1e1e1e 0%, #2d2d2d 100%); border: 2px solid #ff4444; border-radius: 16px; box-shadow: 0 0 30px rgba(255,68,68,.2), 0 10px 40px rgba(0,0,0,.4); overflow: hidden; transform: translateY(8px); opacity: 0; animation: cardIn .8s ease-out forwards; position: relative; }
        .card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #ff0000, #ff4500, #ff1493, #dc143c); animation: dangerBorder 2s linear infinite; }
        .card-header { padding: 20px 24px; border-bottom: 2px solid #444; background: linear-gradient(135deg, rgba(255,0,0,.05) 0%, rgba(255,69,0,.05) 100%); position: relative; }
        .card-header::after { content: '⚠️'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 28px; animation: pulse 2s infinite; }
        h1 { margin: 0; font-size: 24px; color: #ff4444; font-weight: 700; text-shadow: 0 0 10px rgba(255,68,68,.5); letter-spacing: 1px; text-transform: uppercase; }
        .card-body { padding: 24px; animation: fadeIn .8s ease .2s both; text-align: center; }
        p { color: #cccccc; font-size: 16px; line-height: 1.6; margin-bottom: 20px; }
        .team-info { background: rgba(255,68,68,.1); border: 1px solid #ff4444; border-radius: 8px; padding: 16px; margin: 20px 0; }
        .team-name { color: #ff6b6b; font-weight: 700; font-size: 18px; }
        .captain-name { color: #ffaa00; font-weight: 600; }
        .game-title { color: #00ff80; font-weight: 600; }
        .actions { display: flex; justify-content: center; gap: 16px; margin-top: 24px; }
        .btn { padding: 14px 24px; text-decoration: none; border-radius: 12px; border: 2px solid transparent; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all .3s ease; position: relative; overflow: hidden; }
        .btn::before { content: ''; position: absolute; inset: 0; background: linear-gradient(45deg, transparent, rgba(255,255,255,.1), transparent); transform: translateX(-100%); transition: transform .6s ease; }
        .btn:hover::before { transform: translateX(100%); }
        .btn:active { transform: translateY(2px); }
        .btn-confirm { background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); color: white; border-color: #ff0000; box-shadow: 0 4px 15px rgba(255,0,0,.3); }
        .btn-confirm:hover { background: linear-gradient(135deg, #dd0000 0%, #aa0000 100%); box-shadow: 0 6px 20px rgba(255,0,0,.4); transform: translateY(-2px); }
        .btn-cancel { background: linear-gradient(135deg, #333 0%, #555 100%); color: #e0e0e0; border-color: #666; }
        .btn-cancel:hover { background: linear-gradient(135deg, #444 0%, #666 100%); border-color: #00ffff; color: #00ffff; }
        .warning-icon { font-size: 48px; color: #ff4444; margin-bottom: 16px; animation: pulse 2s infinite; }

        @keyframes cardIn { to { transform: translateY(0); opacity: 1; } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes floatBg { 0% { background-position: 0% 0%, 100% 0%, 0% 100%, 100% 100%; } 100% { background-position: 10% 5%, 90% 10%, 5% 90%, 95% 95%; } }
        @keyframes dangerBorder { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
        @keyframes pulse { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.1); opacity: 0.8; } }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Remove Team Registration</h1>
            </div>
            <div class="card-body">
                <div class="warning-icon">🛑</div>
                <p>Are you sure you want to <strong>permanently remove</strong> this team from the tournament?</p>
                
                <div class="team-info">
                    <div class="team-name">Team: <?= $signup['team_name'] ?></div>
                    <div class="captain-name">Captain: <?= $signup['captain_name'] ?></div>
                    <div class="game-title">Game: <?= $signup['game_title'] ?></div>
                </div>
                
                <p style="color: #ff6b6b; font-weight: 600;">⚡ This action cannot be undone!</p>
                
                <form action="<?= site_url('users/delete/' . $signup['id']) ?>" method="POST">
                    <div class="actions">
                        <button type="submit" class="btn btn-confirm">🗑️ Remove Team</button>
                        <a href="<?= site_url('users/view') ?>" class="btn btn-cancel">↩️ Keep Team</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>