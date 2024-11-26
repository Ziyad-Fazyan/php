<?php
session_start();

// Inisialisasi atau ambil high score
if (!isset($_SESSION['highscore'])) {
    $_SESSION['highscore'] = 0;
}

// Update high score via AJAX
if (isset($_POST['newScore'])) {
    $newScore = intval($_POST['newScore']);
    if ($newScore > $_SESSION['highscore']) {
        $_SESSION['highscore'] = $newScore;
        echo $_SESSION['highscore'];
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Space Shooter</title>
    <style>
        body {
            margin: 0;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Press Start 2P', cursive;
            color: #fff;
        }
        
        .game-container {
            position: relative;
        }
        
        #gameCanvas {
            border: 2px solid #0f0;
            box-shadow: 0 0 20px #0f0;
        }
        
        .hud {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 20px;
            color: #0f0;
        }
        
        .game-over {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.9);
            padding: 20px;
            text-align: center;
            border: 2px solid #0f0;
        }
        
        button {
            background: #0f0;
            color: #000;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        button:hover {
            background: #0c0;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <canvas id="gameCanvas" width="800" height="600"></canvas>
        <div class="hud">
            Score: <span id="score">0</span><br>
            High Score: <span id="highScore"><?php echo $_SESSION['highscore']; ?></span><br>
            Level: <span id="level">1</span>
        </div>
        <div id="gameOver" class="game-over">
            <h2>Game Over!</h2>
            <p>Score: <span id="finalScore">0</span></p>
            <button onclick="resetGame()">Play Again</button>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        
        // Game objects
        const player = {
            x: canvas.width / 2,
            y: canvas.height - 50,
            width: 50,
            height: 50,
            speed: 5,
            color: '#0f0'
        };
        
        let bullets = [];
        let enemies = [];
        let particles = [];
        let score = 0;
        let level = 1;
        let gameOver = false;
        
        // Controls
        const keys = {
            left: false,
            right: false,
            space: false
        };
        
        // Event listeners
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') keys.left = true;
            if (e.key === 'ArrowRight') keys.right = true;
            if (e.key === ' ') keys.space = true;
        });
        
        document.addEventListener('keyup', (e) => {
            if (e.key === 'ArrowLeft') keys.left = false;
            if (e.key === 'ArrowRight') keys.right = false;
            if (e.key === ' ') keys.space = false;
        });
        
        // Game functions
        function createEnemy() {
            const enemy = {
                x: Math.random() * (canvas.width - 30),
                y: -30,
                width: 30,
                height: 30,
                speed: 2 + (level * 0.5),
                color: '#f00'
            };
            enemies.push(enemy);
        }
        
        function createBullet() {
            const bullet = {
                x: player.x + player.width / 2 - 2.5,
                y: player.y,
                width: 5,
                height: 15,
                speed: 7,
                color: '#0f0'
            };
            bullets.push(bullet);
        }
        
        function createParticles(x, y, color) {
            for (let i = 0; i < 10; i++) {
                const particle = {
                    x: x,
                    y: y,
                    size: Math.random() * 3 + 1,
                    speedX: (Math.random() - 0.5) * 8,
                    speedY: (Math.random() - 0.5) * 8,
                    color: color,
                    life: 1
                };
                particles.push(particle);
            }
        }
        
        function updateParticles() {
            for (let i = particles.length - 1; i >= 0; i--) {
                const p = particles[i];
                p.x += p.speedX;
                p.y += p.speedY;
                p.life -= 0.02;
                
                if (p.life <= 0) {
                    particles.splice(i, 1);
                }
            }
        }
        
        function drawParticles() {
            particles.forEach(p => {
                ctx.fillStyle = p.color + Math.floor(p.life * 255).toString(16);
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fill();
            });
        }
        
        function checkCollision(rect1, rect2) {
            return rect1.x < rect2.x + rect2.width &&
                   rect1.x + rect1.width > rect2.x &&
                   rect1.y < rect2.y + rect2.height &&
                   rect1.y + rect1.height > rect2.y;
        }
        
        function updateGame() {
            // Move player
            if (keys.left && player.x > 0) player.x -= player.speed;
            if (keys.right && player.x < canvas.width - player.width) player.x += player.speed;
            
            // Shoot
            if (keys.space) {
                if (bullets.length === 0 || 
                    bullets[bullets.length - 1].y < player.y - 30) {
                    createBullet();
                }
            }
            
            // Update bullets
            for (let i = bullets.length - 1; i >= 0; i--) {
                bullets[i].y -= bullets[i].speed;
                if (bullets[i].y < 0) bullets.splice(i, 1);
            }
            
            // Create enemies
            if (Math.random() < 0.02 + (level * 0.005)) {
                createEnemy();
            }
            
            // Update enemies
            for (let i = enemies.length - 1; i >= 0; i--) {
                enemies[i].y += enemies[i].speed;
                
                // Check collision with player
                if (checkCollision(enemies[i], player)) {
                    createParticles(player.x + player.width/2, player.y + player.height/2, '#0f0');
                    endGame();
                    return;
                }
                
                // Check collision with bullets
                for (let j = bullets.length - 1; j >= 0; j--) {
                    if (checkCollision(enemies[i], bullets[j])) {
                        createParticles(enemies[i].x + enemies[i].width/2, enemies[i].y + enemies[i].height/2, '#f00');
                        enemies.splice(i, 1);
                        bullets.splice(j, 1);
                        score += 10;
                        if (score % 100 === 0) level++;
                        document.getElementById('score').textContent = score;
                        document.getElementById('level').textContent = level;
                        break;
                    }
                }
                
                // Remove enemies that pass the bottom
                if (enemies[i] && enemies[i].y > canvas.height) {
                    enemies.splice(i, 1);
                }
            }
            
            updateParticles();
        }
        
        function drawGame() {
            // Clear canvas
            ctx.fillStyle = '#000';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Draw player
            ctx.fillStyle = player.color;
            ctx.fillRect(player.x, player.y, player.width, player.height);
            
            // Draw bullets
            ctx.fillStyle = '#0f0';
            bullets.forEach(bullet => {
                ctx.fillRect(bullet.x, bullet.y, bullet.width, bullet.height);
            });
            
            // Draw enemies
            ctx.fillStyle = '#f00';
            enemies.forEach(enemy => {
                ctx.fillRect(enemy.x, enemy.y, enemy.width, enemy.height);
            });
            
            // Draw particles
            drawParticles();
        }
        
        function gameLoop() {
            if (!gameOver) {
                updateGame();
                drawGame();
                requestAnimationFrame(gameLoop);
            }
        }
        
        function endGame() {
            gameOver = true;
            document.getElementById('gameOver').style.display = 'block';
            document.getElementById('finalScore').textContent = score;
            
            // Update high score
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'newScore=' + score
            })
            .then(response => response.text())
            .then(newHighScore => {
                document.getElementById('highScore').textContent = newHighScore;
            });
        }
        
        function resetGame() {
            player.x = canvas.width / 2;
            bullets = [];
            enemies = [];
            particles = [];
            score = 0;
            level = 1;
            gameOver = false;
            document.getElementById('score').textContent = '0';
            document.getElementById('level').textContent = '1';
            document.getElementById('gameOver').style.display = 'none';
            gameLoop();
        }
        
        // Start game
        gameLoop();
    </script>
</body>
</html>