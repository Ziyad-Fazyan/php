<?php
session_start();

// Inisialisasi game baru
if (!isset($_SESSION['cards']) || isset($_POST['reset'])) {
    $symbols = ['🎮', '🎲', '🎯', '🎪', '🎨', '🎭', '🎪', '🎯', '🎲', '🎮', '🎨', '🎭'];
    shuffle($symbols);
    $_SESSION['cards'] = $symbols;
    $_SESSION['flipped'] = array_fill(0, 12, false);
    $_SESSION['matched'] = array_fill(0, 12, false);
    $_SESSION['moves'] = 0;
    $_SESSION['first_flip'] = null;
    $_SESSION['score'] = 0;
}

// Proses ketika kartu di klik
if (isset($_POST['flip'])) {
    $index = $_POST['flip'];
    
    if (!$_SESSION['matched'][$index] && !$_SESSION['flipped'][$index]) {
        $_SESSION['flipped'][$index] = true;
        $_SESSION['moves']++;
        
        if ($_SESSION['first_flip'] === null) {
            $_SESSION['first_flip'] = $index;
        } else {
            // Cek apakah kartu cocok
            if ($_SESSION['cards'][$_SESSION['first_flip']] === $_SESSION['cards'][$index]) {
                $_SESSION['matched'][$_SESSION['first_flip']] = true;
                $_SESSION['matched'][$index] = true;
                $_SESSION['score'] += 10;
            } else {
                // Reset kartu yang tidak cocok setelah 1 detik
                header("Refresh:1");
                $_SESSION['flipped'][$_SESSION['first_flip']] = false;
                $_SESSION['flipped'][$index] = false;
                $_SESSION['score'] = max(0, $_SESSION['score'] - 2);
            }
            $_SESSION['first_flip'] = null;
        }
    }
}

$gameComplete = !in_array(false, $_SESSION['matched']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Memory Card Game</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 100%;
        }
        .game-board {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 20px 0;
        }
        .card {
            aspect-ratio: 1;
            background-color: #4a90e2;
            border: none;
            border-radius: 8px;
            font-size: 2em;
            cursor: pointer;
            transition: all 0.3s ease;
            transform-style: preserve-3d;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .card.flipped {
            background-color: #fff;
            border: 2px solid #4a90e2;
            transform: rotateY(180deg);
        }
        .card.matched {
            background-color: #66bb6a;
            cursor: default;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 1.2em;
            color: #333;
        }
        .reset-btn {
            background-color: #f50057;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .reset-btn:hover {
            background-color: #c51162;
        }
        .victory {
            text-align: center;
            color: #4a90e2;
            font-size: 1.5em;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; color: #333;">Memory Card Game</h1>
        
        <div class="stats">
            <div>Langkah: <?php echo $_SESSION['moves']; ?></div>
            <div>Skor: <?php echo $_SESSION['score']; ?></div>
        </div>

        <form method="post" class="game-board">
            <?php for ($i = 0; $i < 12; $i++): ?>
                <button type="submit" name="flip" value="<?php echo $i; ?>" 
                        class="card <?php echo $_SESSION['flipped'][$i] || $_SESSION['matched'][$i] ? 'flipped' : ''; ?> 
                                   <?php echo $_SESSION['matched'][$i] ? 'matched' : ''; ?>"
                        <?php echo $_SESSION['matched'][$i] ? 'disabled' : ''; ?>>
                    <?php echo $_SESSION['flipped'][$i] || $_SESSION['matched'][$i] ? $_SESSION['cards'][$i] : ''; ?>
                </button>
            <?php endfor; ?>
        </form>

        <?php if ($gameComplete): ?>
            <div class="victory">
                🎉 Selamat! Anda menyelesaikan permainan dalam <?php echo $_SESSION['moves']; ?> langkah!
            </div>
        <?php endif; ?>

        <form method="post" style="text-align: center; margin-top: 20px;">
            <button type="submit" name="reset" class="reset-btn">Mulai Baru</button>
        </form>
    </div>
</body>
</html>