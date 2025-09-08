<!DOCTYPE html>
<html>
<head>
    <title>Tournament Signup</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Arial', sans-serif; color: #e0e0e0; background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%); min-height: 100vh; }
        .bg-decor { position: fixed; inset: 0; z-index: -1; pointer-events: none; background:
            radial-gradient(600px 600px at 0% 0%, rgba(0,255,255,.08), transparent 60%),
            radial-gradient(600px 600px at 100% 0%, rgba(255,0,255,.06), transparent 60%),
            radial-gradient(600px 600px at 0% 100%, rgba(0,255,127,.05), transparent 60%),
            radial-gradient(600px 600px at 100% 100%, rgba(255,127,0,.07), transparent 60%);
            animation: floatBg 20s ease-in-out infinite alternate; }
        .container { max-width: 720px; margin: 40px auto; padding: 0 16px; }
        .card { background: linear-gradient(145deg, #1e1e1e 0%, #2d2d2d 100%); border: 2px solid #00ffff; border-radius: 16px; box-shadow: 0 0 30px rgba(0,255,255,.2), 0 10px 40px rgba(0,0,0,.4); overflow: hidden; transform: translateY(8px); opacity: 0; animation: cardIn .8s ease-out forwards; position: relative; }
        .card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #ff0080, #ff8c00, #00ff80, #0080ff, #8000ff); animation: borderGlow 3s linear infinite; }
        .card-header { padding: 20px 24px; border-bottom: 2px solid #444; background: linear-gradient(135deg, rgba(0,255,255,.05) 0%, rgba(255,0,255,.05) 100%); position: relative; }
        .card-header::after { content: '🎮'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 24px; opacity: 0.7; }
        .title { margin: 0; font-size: 24px; color: #00ffff; font-weight: 700; text-shadow: 0 0 10px rgba(0,255,255,.5); letter-spacing: 1px; }
        .card-body { padding: 24px; animation: fadeIn .8s ease .2s both; }
        .form-group { margin-bottom: 20px; position: relative; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #00ff80; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; }
        input[type="text"] { width: 100%; max-width: 420px; padding: 14px 16px; border: 2px solid #333; border-radius: 8px; background: linear-gradient(145deg, #2a2a2a 0%, #1e1e1e 100%); color: #e0e0e0; transition: all .3s ease; font-size: 16px; }
        input[type="text"]:focus { outline: none; border-color: #00ffff; box-shadow: 0 0 20px rgba(0,255,255,.3); background: linear-gradient(145deg, #2e2e2e 0%, #222 100%); }
        input[type="text"]::placeholder { color: #666; }
        .actions { display: flex; gap: 12px; margin-top: 24px; }
        .btn { display: inline-block; padding: 14px 24px; text-decoration: none; border-radius: 12px; border: 2px solid transparent; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all .3s ease; position: relative; overflow: hidden; }
        .btn::before { content: ''; position: absolute; inset: 0; background: linear-gradient(45deg, transparent, rgba(255,255,255,.1), transparent); transform: translateX(-100%); transition: transform .6s ease; }
        .btn:hover::before { transform: translateX(100%); }
        .btn:active { transform: translateY(2px); }
        .btn-primary { background: linear-gradient(135deg, #ff0080 0%, #ff8c00 100%); color: white; border-color: #ff0080; box-shadow: 0 4px 15px rgba(255,0,128,.3); }
        .btn-primary:hover { background: linear-gradient(135deg, #e6006b 0%, #e67300 100%); box-shadow: 0 6px 20px rgba(255,0,128,.4); transform: translateY(-2px); }
        .btn-secondary { background: linear-gradient(135deg, #333 0%, #555 100%); color: #e0e0e0; border-color: #666; }
        .btn-secondary:hover { background: linear-gradient(135deg, #444 0%, #666 100%); border-color: #00ffff; color: #00ffff; }
        .gaming-elements { position: absolute; top: 10px; right: 10px; font-size: 12px; color: #666; }

        @keyframes cardIn { to { transform: translateY(0); opacity: 1; } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes floatBg { 0% { background-position: 0% 0%, 100% 0%, 0% 100%, 100% 100%; } 100% { background-position: 10% 5%, 90% 10%, 5% 90%, 95% 95%; } }
        @keyframes borderGlow { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="container">
    <div class="card">
        <div class="gaming-elements">🏆 ESPORTS</div>
        <div class="card-header">
            <h1 class="title">Tournament Registration</h1>
        </div>
        <div class="card-body">
            <form action="<?= site_url('users/create') ?>" method="POST">
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