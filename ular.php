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
    <title>Snake Game</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(45deg, #1a1a1a, #4a4a4a);
            font-family: 'Press Start 2P', cursive;
            color: #fff;
        }
        
        .game-container {
            text-align: center;
        }
        
        #gameCanvas {
            border: 3px solid #00ff00;
            background-color: #000;
            box-shadow: 0 0 20px #00ff00;
        }
        
        .score-board {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            padding: 10px;
            background: rgba(0, 255, 0, 0.1);
            border: 2px solid #00ff00;
        }
        
        .controls {
            margin-top: 20px;
            color: #00ff00;
        }
        
        .game-over {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.9);
            padding: 20px;
            border: 2px solid #00ff00;
            text-align: center;
        }
        
        button {
            background: #00ff00;
            color: #000;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            font-family: 'Press Start 2P', cursive;
        }
        
        button:hover {
            background: #00cc00;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <div class="score-board">
            <div>Score: <span id="score">0</span></div>
            <div>High Score: <span id="highScore"><?php echo $_SESSION['highscore']; ?></span></div>
        </div>
        
        <canvas id="gameCanvas" width="400" height="400"></canvas>
        
        <div class="controls">
            <p>Use Arrow Keys to Move</p>
            <button onclick="resetGame()">New Game</button>
        </div>
        
        <div id="gameOver" class="game-over">
            <h2>Game Over!</h2>
            <p>Final Score: <span id="finalScore">0</span></p>
            <button onclick="resetGame()">Play Again</button>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        const gridSize = 20;
        const tileCount = canvas.width / gridSize;
        
        let snake = [];
        let food = {};
        let dx = gridSize;
        let dy = 0;
        let score = 0;
        let gameSpeed = 150;
        let gameLoop;
        
        function initGame() {
            snake = [
                {x: 5 * gridSize, y: 5 * gridSize}
            ];
            createFood();
            score = 0;
            document.getElementById('score').textContent = score;
            document.getElementById('gameOver').style.display = 'none';
        }
        
        function createFood() {
            food = {
                x: Math.floor(Math.random() * tileCount) * gridSize,
                y: Math.floor(Math.random() * tileCount) * gridSize
            };
            
            // Pastikan makanan tidak muncul di tubuh ular
            snake.forEach(segment => {
                if (segment.x === food.x && segment.y === food.y) {
                    createFood();
                }
            });
        }
        
        function drawGame() {
            // Bersihkan canvas
            ctx.fillStyle = '#000';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Gambar makanan
            ctx.fillStyle = '#ff0000';
            ctx.fillRect(food.x, food.y, gridSize - 2, gridSize - 2);
            
            // Gambar ular
            snake.forEach((segment, index) => {
                ctx.fillStyle = index === 0 ? '#00ff00' : '#008800';
                ctx.fillRect(segment.x, segment.y, gridSize - 2, gridSize - 2);
            });
        }
        
        function moveSnake() {
            const head = {x: snake[0].x + dx, y: snake[0].y + dy};
            
            // Cek tabrakan dengan dinding
            if (head.x < 0 || head.x >= canvas.width || 
                head.y < 0 || head.y >= canvas.height) {
                gameOver();
                return;
            }
            
            // Cek tabrakan dengan tubuh sendiri
            for (let i = 0; i < snake.length; i++) {
                if (head.x === snake[i].x && head.y === snake[i].y) {
                    gameOver();
                    return;
                }
            }
            
            snake.unshift(head);
            
            // Cek makan
            if (head.x === food.x && head.y === food.y) {
                score += 10;
                document.getElementById('score').textContent = score;
                createFood();
                
                // Tingkatkan kecepatan
                if (score % 50 === 0 && gameSpeed > 50) {
                    gameSpeed -= 10;
                    clearInterval(gameLoop);
                    gameLoop = setInterval(moveSnake, gameSpeed);
                }
            } else {
                snake.pop();
            }
            
            drawGame();
        }
        
        function gameOver() {
            clearInterval(gameLoop);
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
            clearInterval(gameLoop);
            initGame();
            gameSpeed = 150;
            dx = gridSize;
            dy = 0;
            gameLoop = setInterval(moveSnake, gameSpeed);
        }
        
        document.addEventListener('keydown', (event) => {
            switch(event.key) {
                case 'ArrowUp':
                    if (dy === 0) {
                        dx = 0;
                        dy = -gridSize;
                    }
                    break;
                case 'ArrowDown':
                    if (dy === 0) {
                        dx = 0;
                        dy = gridSize;
                    }
                    break;
                case 'ArrowLeft':
                    if (dx === 0) {
                        dx = -gridSize;
                        dy = 0;
                    }
                    break;
                case 'ArrowRight':
                    if (dx === 0) {
                        dx = gridSize;
                        dy = 0;
                    }
                    break;
            }
        });
        
        // Mulai game
        resetGame();
    </script>
</body>
</html>