<!DOCTYPE html>
<html>
<head>
    <title>Tournament Registrations</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Arial', sans-serif; color: #e0e0e0; background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%); min-height: 100vh; }
        .bg-decor { position: fixed; inset: 0; z-index: -1; pointer-events: none; background:
            radial-gradient(600px 600px at 0% 0%, rgba(0,255,255,.08), transparent 60%),
            radial-gradient(600px 600px at 100% 0%, rgba(255,0,255,.06), transparent 60%),
            radial-gradient(600px 600px at 0% 100%, rgba(0,255,127,.05), transparent 60%),
            radial-gradient(600px 600px at 100% 100%, rgba(255,127,0,.07), transparent 60%);
            animation: floatBg 20s ease-in-out infinite alternate; }
        .container { max-width: 1100px; margin: 40px auto; padding: 0 16px; }
        .card { background: linear-gradient(145deg, #1e1e1e 0%, #2d2d2d 100%); border: 2px solid #00ffff; border-radius: 16px; box-shadow: 0 0 30px rgba(0,255,255,.2), 0 10px 40px rgba(0,0,0,.4); overflow: hidden; transform: translateY(8px); opacity: 0; animation: cardIn .8s ease-out forwards; position: relative; }
        .card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #00ffff, #ff00ff, #00ff80, #ffaa00); animation: borderFlow 4s linear infinite; }
        .card-header { display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; border-bottom: 2px solid #444; background: linear-gradient(135deg, rgba(0,255,255,.05) 0%, rgba(255,0,255,.05) 100%); position: relative; }
        .card-header::before { content: '🏆'; position: absolute; left: -5px; top: 50%; transform: translateY(-50%); font-size: 32px; opacity: 0.3; animation: pulse 3s infinite; }
        .title { margin: 0; font-size: 28px; letter-spacing: 1px; color: #00ffff; font-weight: 700; text-shadow: 0 0 15px rgba(0,255,255,.5); text-transform: uppercase; padding-left: 40px; }
        .actions { display: flex; gap: 12px; }
        .table-wrapper { overflow-x: auto; animation: fadeIn .8s ease .2s both; background: rgba(0,0,0,.2); }
        table { border-collapse: collapse; width: 100%; }
        th, td { border-bottom: 1px solid #333; padding: 16px 18px; text-align: left; }
        th { background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%); font-weight: 700; color: #00ff80; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; border-top: 1px solid #00ff80; }
        tr { transition: all .3s ease; }
        tr:hover td { background: rgba(0,255,255,.05); box-shadow: inset 0 0 20px rgba(0,255,255,.1); }
        .team-name { color: #00ffff; font-weight: 600; }
        .captain-name { color: #ffaa00; }
        .game-title { color: #ff6b9d; font-weight: 500; }
        .btn { display: inline-block; padding: 12px 18px; text-decoration: none; border-radius: 10px; border: 2px solid transparent; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; transition: all .3s ease; position: relative; overflow: hidden; }
        .btn::before { content: ''; position: absolute; inset: 0; background: linear-gradient(45deg, transparent, rgba(255,255,255,.1), transparent); transform: translateX(-100%); transition: transform .6s ease; }
        .btn:hover::before { transform: translateX(100%); }
        .btn:active { transform: translateY(1px); }
        .btn-primary { background: linear-gradient(135deg, #00ffff 0%, #0099cc 100%); color: #1a1a1a; border-color: #00ffff; box-shadow: 0 4px 15px rgba(0,255,255,.2); font-weight: 700; }
        .btn-primary:hover { background: linear-gradient(135deg, #00cccc 0%, #0077aa 100%); box-shadow: 0 6px 20px rgba(0,255,255,.3); transform: translateY(-2px); }
        .btn-edit { background: linear-gradient(135deg, #ffaa00 0%, #ff8800 100%); color: #1a1a1a; border-color: #ffaa00; box-shadow: 0 4px 15px rgba(255,170,0,.2); }
        .btn-edit:hover { background: linear-gradient(135deg, #ff9900 0%, #ff7700 100%); box-shadow: 0 6px 20px rgba(255,170,0,.3); transform: translateY(-2px); }
        .btn-delete { background: linear-gradient(135deg, #ff4444 0%, #cc0000 100%); color: white; border-color: #ff4444; box-shadow: 0 4px 15px rgba(255,68,68,.2); }
        .btn-delete:hover { background: linear-gradient(135deg, #ff2222 0%, #aa0000 100%); box-shadow: 0 6px 20px rgba(255,68,68,.3); transform: translateY(-2px); }
        .empty { padding: 40px; text-align: center; color: #666; font-size: 18px; font-style: italic; }
        .action-buttons { display: flex; gap: 8px; align-items: center; }
        .stats-bar { background: rgba(0,255,255,.1); padding: 10px 20px; border-bottom: 1px solid #333; color: #00ffff; font-size: 14px; }
        .gaming-elements { position: absolute; top: 15px; right: 15px; font-size: 14px; color: #666; display: flex; gap: 10px; }
        .id-badge { background: linear-gradient(135deg, #333, #555); color: #00ffff; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 12px; }

        @keyframes cardIn { to { transform: translateY(0); opacity: 1; } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes floatBg { 0% { background-position: 0% 0%, 100% 0%, 0% 100%, 100% 100%; } 100% { background-position: 10% 5%, 90% 10%, 5% 90%, 95% 95%; } }
        @keyframes borderFlow { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
        @keyframes pulse { 0%, 100% { opacity: 0.3; transform: translateY(-50%) scale(1); } 50% { opacity: 0.6; transform: translateY(-50%) scale(1.1); } }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="container">
    <div class="card">
        <div class="gaming-elements">
            <span>🎮 ESPORTS</span>
            <span>⚡ LIVE</span>
        </div>
        <div class="card-header">
            <h1 class="title">Tournament Registrations</h1>
            <div class="actions">
                <a href="<?= site_url('users/create') ?>" class="btn btn-primary">🎯 Register Team</a>
            </div>
        </div>
        
        <?php if (!empty($signups)): ?>
        <div class="stats-bar">
            📊 Total Registered Teams: <strong><?= count($signups) ?></strong>
        </div>
        <?php endif; ?>
        
        <div class="table-wrapper">
        <table>
            <tr>
                <th>Team ID</th>
                <th>Team Name</th>
                <th>Team Captain</th>
                <th>Game Title</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($signups)): ?>
                <?php foreach($signups as $signup): ?>
                <tr>
                    <td><span class="id-badge">#<?= $signup['id'] ?></span></td>
                    <td class="team-name"><?= $signup['team_name'] ?></td>
                    <td class="captain-name"><?= $signup['captain_name'] ?></td>
                    <td class="game-title"><?= $signup['game_title'] ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="<?= site_url('users/update/' . $signup['id']) ?>" class="btn btn-edit">⚙️ Edit</a>
                            <a href="<?= site_url('users/delete/' . $signup['id']) ?>" class="btn btn-delete">🗑️ Remove</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="empty">🎮 No teams registered yet. Be the first to join the tournament!</td>
                </tr>
            <?php endif; ?>
        </table>
        </div>
    </div>
    </div>
</body>
</html>