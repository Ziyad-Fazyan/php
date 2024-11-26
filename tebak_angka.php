<?php
session_start();

// Inisialisasi atau reset game
if (!isset($_SESSION['number']) || isset($_POST['reset'])) {
    $_SESSION['number'] = rand(1, 100);
    $_SESSION['attempts'] = 0;
    $_SESSION['history'] = array();
}

$message = '';
$gameOver = false;

// Proses tebakan
if (isset($_POST['guess'])) {
    $guess = intval($_POST['guess']);
    $_SESSION['attempts']++;
    
    if ($guess == $_SESSION['number']) {
        $message = "Selamat! Anda berhasil menebak angka {$_SESSION['number']} dalam {$_SESSION['attempts']} percobaan!";
        $gameOver = true;
    } elseif ($guess < $_SESSION['number']) {
        $message = "Terlalu rendah! Coba lagi dengan angka yang lebih besar.";
    } else {
        $message = "Terlalu tinggi! Coba lagi dengan angka yang lebih kecil.";
    }
    
    // Simpan history tebakan
    $_SESSION['history'][] = array(
        'guess' => $guess,
        'message' => $message
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Game Tebak Angka</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .history {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #e9ecef;
        }
        button, input {
            padding: 8px 15px;
            margin: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Game Tebak Angka</h1>
        <p>Tebak angka antara 1 sampai 100!</p>
        
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!$gameOver): ?>
            <form method="post">
                <input type="number" name="guess" min="1" max="100" required>
                <button type="submit">Tebak!</button>
            </form>
        <?php endif; ?>
        
        <form method="post">
            <button type="submit" name="reset">Mulai Game Baru</button>
        </form>
        
        <?php if (!empty($_SESSION['history'])): ?>
            <div class="history">
                <h3>Riwayat Tebakan:</h3>
                <?php foreach (array_reverse($_SESSION['history']) as $entry): ?>
                    <div class="message">
                        Tebakan: <?php echo $entry['guess']; ?> - 
                        <?php echo $entry['message']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <p>Jumlah percobaan: <?php echo $_SESSION['attempts']; ?></p>
    </div>
</body>
</html>