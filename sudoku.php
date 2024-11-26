<?php
session_start();

class SudokuGenerator {
    private $grid = array();
    
    public function __construct() {
        for($i = 0; $i < 9; $i++) {
            for($j = 0; $j < 9; $j++) {
                $this->grid[$i][$j] = 0;
            }
        }
    }
    
    private function isValid($row, $col, $num) {
        // Check row
        for($x = 0; $x < 9; $x++) {
            if($this->grid[$row][$x] == $num) return false;
        }
        
        // Check column
        for($x = 0; $x < 9; $x++) {
            if($this->grid[$x][$col] == $num) return false;
        }
        
        // Check 3x3 box
        $startRow = $row - $row % 3;
        $startCol = $col - $col % 3;
        for($i = 0; $i < 3; $i++) {
            for($j = 0; $j < 3; $j++) {
                if($this->grid[$i + $startRow][$j + $startCol] == $num) return false;
            }
        }
        
        return true;
    }
    
    private function solveSudoku() {
        $row = $col = 0;
        $isEmpty = false;
        
        for($i = 0; $i < 9; $i++) {
            for($j = 0; $j < 9; $j++) {
                if($this->grid[$i][$j] == 0) {
                    $row = $i;
                    $col = $j;
                    $isEmpty = true;
                    break;
                }
            }
            if($isEmpty) break;
        }
        
        if(!$isEmpty) return true;
        
        for($num = 1; $num <= 9; $num++) {
            if($this->isValid($row, $col, $num)) {
                $this->grid[$row][$col] = $num;
                if($this->solveSudoku()) return true;
                $this->grid[$row][$col] = 0;
            }
        }
        return false;
    }
    
    public function generatePuzzle($difficulty = 40) {
        // Fill diagonal boxes
        for($i = 0; $i < 9; $i += 3) {
            for($j = 0; $j < 3; $j++) {
                for($k = 0; $k < 3; $k++) {
                    do {
                        $num = rand(1, 9);
                    } while(!$this->isValid($i + $j, $i + $k, $num));
                    $this->grid[$i + $j][$i + $k] = $num;
                }
            }
        }
        
        // Solve the rest
        $this->solveSudoku();
        
        // Create puzzle by removing numbers
        $solution = $this->grid;
        $holes = $difficulty;
        while($holes > 0) {
            $row = rand(0, 8);
            $col = rand(0, 8);
            if($this->grid[$row][$col] != 0) {
                $this->grid[$row][$col] = 0;
                $holes--;
            }
        }
        
        return array($this->grid, $solution);
    }
}

// Handle new game request
if(!isset($_SESSION['puzzle']) || isset($_POST['new_game'])) {
    $generator = new SudokuGenerator();
    list($_SESSION['puzzle'], $_SESSION['solution']) = $generator->generatePuzzle(40);
    $_SESSION['mistakes'] = 0;
    $_SESSION['start_time'] = time();
}

// Handle number input
if(isset($_POST['cell']) && isset($_POST['number'])) {
    list($row, $col) = explode(',', $_POST['cell']);
    $number = intval($_POST['number']);
    
    if($_SESSION['solution'][$row][$col] == $number) {
        $_SESSION['puzzle'][$row][$col] = $number;
    } else {
        $_SESSION['mistakes']++;
    }
    
    // Check if puzzle is completed
    $completed = true;
    for($i = 0; $i < 9; $i++) {
        for($j = 0; $j < 9; $j++) {
            if($_SESSION['puzzle'][$i][$j] != $_SESSION['solution'][$i][$j]) {
                $completed = false;
                break 2;
            }
        }
    }
    
    if($completed) {
        $time_taken = time() - $_SESSION['start_time'];
        $_SESSION['game_complete'] = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sudoku Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .sudoku-grid {
            display: grid;
            grid-template-columns: repeat(9, 40px);
            gap: 1px;
            padding: 3px;
            background: #333;
            margin: 20px auto;
        }
        
        .cell {
            width: 40px;
            height: 40px;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .cell:nth-child(9n+1),
        .cell:nth-child(9n+2),
        .cell:nth-child(9n+3) {
            border-right: 2px solid #333;
        }
        
        .cell:nth-child(n+19):nth-child(-n+27),
        .cell:nth-child(n+46):nth-child(-n+54) {
            border-bottom: 2px solid #333;
        }
        
        .original {
            color: #333;
            background: #f0f0f0;
        }
        
        .selected {
            background: #e3f2fd;
        }
        
        .number-pad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 5px;
            max-width: 200px;
            margin: 20px auto;
        }
        
        .number-btn {
            padding: 10px;
            font-size: 18px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .number-btn:hover {
            background: #45a049;
        }
        
        .stats {
            margin: 20px 0;
            font-size: 18px;
        }
        
        .new-game-btn {
            padding: 10px 20px;
            font-size: 16px;
            background: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        
        .new-game-btn:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sudoku</h1>
        
        <?php if(isset($_SESSION['game_complete'])): ?>
            <div class="stats">
                <h2>Selamat! Puzzle Selesai!</h2>
                <p>Waktu: <?php echo gmdate("H:i:s", time() - $_SESSION['start_time']); ?></p>
                <p>Kesalahan: <?php echo $_SESSION['mistakes']; ?></p>
            </div>
        <?php else: ?>
            <div class="stats">
                <p>Waktu: <span id="timer">00:00:00</span></p>
                <p>Kesalahan: <?php echo $_SESSION['mistakes']; ?></p>
            </div>
        <?php endif; ?>
        
        <div class="sudoku-grid">
            <?php for($i = 0; $i < 9; $i++): ?>
                <?php for($j = 0; $j < 9; $j++): ?>
                    <div class="cell <?php echo $_SESSION['puzzle'][$i][$j] == 0 ? '' : 'original'; ?>" 
                         data-pos="<?php echo $i.','.$j; ?>">
                        <?php echo $_SESSION['puzzle'][$i][$j] == 0 ? '' : $_SESSION['puzzle'][$i][$j]; ?>
                    </div>
                <?php endfor; ?>
            <?php endfor; ?>
        </div>
        
        <div class="number-pad">
            <?php for($i = 1; $i <= 9; $i++): ?>
                <button class="number-btn" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
            <?php endfor; ?>
        </div>
        
        <form method="post">
            <button type="submit" name="new_game" class="new-game-btn">Game Baru</button>
        </form>
    </div>

    <script>
        let selectedCell = null;
        
        // Timer
        const startTime = <?php echo $_SESSION['start_time']; ?> * 1000;
        const timerElement = document.getElementById('timer');
        
        function updateTimer() {
            const now = new Date().getTime();
            const distance = now - startTime;
            
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            timerElement.innerHTML = 
                (hours < 10 ? "0" + hours : hours) + ":" + 
                (minutes < 10 ? "0" + minutes : minutes) + ":" + 
                (seconds < 10 ? "0" + seconds : seconds);
        }
        
        setInterval(updateTimer, 1000);
        
        // Cell selection
        document.querySelectorAll('.cell').forEach(cell => {
            cell.addEventListener('click', () => {
                if(cell.classList.contains('original')) return;
                
                if(selectedCell) selectedCell.classList.remove('selected');
                cell.classList.add('selected');
                selectedCell = cell;
            });
        });
        
        // Number input
        document.querySelectorAll('.number-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                if(!selectedCell) return;
                
                const number = btn.dataset.number;
                const pos = selectedCell.dataset.pos;
                
                fetch('', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `cell=${pos}&number=${number}`
                })
                .then(response => response.text())
                .then(() => {
                    location.reload();
                });
            });
        });
    </script>
</body>
</html>