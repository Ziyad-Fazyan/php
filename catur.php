<?php
session_start();

class ChessPiece {
    public $type;
    public $color;
    public $symbol;
    
    public function __construct($type, $color) {
        $this->type = $type;
        $this->color = $color;
        $this->setSymbol();
    }
    
    private function setSymbol() {
        $symbols = [
            'white' => [
                'king' => '♔',
                'queen' => '♕',
                'rook' => '♖',
                'bishop' => '♗',
                'knight' => '♘',
                'pawn' => '♙'
            ],
            'black' => [
                'king' => '♚',
                'queen' => '♛',
                'rook' => '♜',
                'bishop' => '♝',
                'knight' => '♞',
                'pawn' => '♟'
            ]
        ];
        $this->symbol = $symbols[$this->color][$this->type];
    }
}

// Inisialisasi papan catur
function initializeBoard() {
    $board = array_fill(0, 8, array_fill(0, 8, null));
    
    // Setup bidak putih
    $board[7][0] = new ChessPiece('rook', 'white');
    $board[7][1] = new ChessPiece('knight', 'white');
    $board[7][2] = new ChessPiece('bishop', 'white');
    $board[7][3] = new ChessPiece('queen', 'white');
    $board[7][4] = new ChessPiece('king', 'white');
    $board[7][5] = new ChessPiece('bishop', 'white');
    $board[7][6] = new ChessPiece('knight', 'white');
    $board[7][7] = new ChessPiece('rook', 'white');
    
    // Pion putih
    for ($i = 0; $i < 8; $i++) {
        $board[6][$i] = new ChessPiece('pawn', 'white');
    }
    
    // Setup bidak hitam
    $board[0][0] = new ChessPiece('rook', 'black');
    $board[0][1] = new ChessPiece('knight', 'black');
    $board[0][2] = new ChessPiece('bishop', 'black');
    $board[0][3] = new ChessPiece('queen', 'black');
    $board[0][4] = new ChessPiece('king', 'black');
    $board[0][5] = new ChessPiece('bishop', 'black');
    $board[0][6] = new ChessPiece('knight', 'black');
    $board[0][7] = new ChessPiece('rook', 'black');
    
    // Pion hitam
    for ($i = 0; $i < 8; $i++) {
        $board[1][$i] = new ChessPiece('pawn', 'black');
    }
    
    return $board;
}

// Inisialisasi game jika belum ada
if (!isset($_SESSION['chess_board'])) {
    $_SESSION['chess_board'] = initializeBoard();
    $_SESSION['current_player'] = 'white';
    $_SESSION['selected_piece'] = null;
    $_SESSION['valid_moves'] = [];
}

// Handle pemilihan bidak dan perpindahan
if (isset($_POST['position'])) {
    $position = explode(',', $_POST['position']);
    $row = (int)$position[0];
    $col = (int)$position[1];
    
    if ($_SESSION['selected_piece'] === null) {
        // Pilih bidak
        $piece = $_SESSION['chess_board'][$row][$col];
        if ($piece && $piece->color === $_SESSION['current_player']) {
            $_SESSION['selected_piece'] = [$row, $col];
            $_SESSION['valid_moves'] = getValidMoves($row, $col, $_SESSION['chess_board']);
        }
    } else {
        // Pindahkan bidak
        $selected = $_SESSION['selected_piece'];
        if (isValidMove($selected[0], $selected[1], $row, $col, $_SESSION['chess_board'])) {
            $_SESSION['chess_board'][$row][$col] = $_SESSION['chess_board'][$selected[0]][$selected[1]];
            $_SESSION['chess_board'][$selected[0]][$selected[1]] = null;
            $_SESSION['current_player'] = $_SESSION['current_player'] === 'white' ? 'black' : 'white';
        }
        $_SESSION['selected_piece'] = null;
        $_SESSION['valid_moves'] = [];
    }
}

// Reset game
if (isset($_POST['reset'])) {
    $_SESSION['chess_board'] = initializeBoard();
    $_SESSION['current_player'] = 'white';
    $_SESSION['selected_piece'] = null;
    $_SESSION['valid_moves'] = [];
}

// Fungsi untuk mendapatkan langkah valid (implementasi sederhana)
function getValidMoves($row, $col, $board) {
    $moves = [];
    $piece = $board[$row][$col];
    
    if ($piece->type === 'pawn') {
        $direction = $piece->color === 'white' ? -1 : 1;
        // Gerakan maju satu langkah
        if (isInBoard($row + $direction, $col) && !$board[$row + $direction][$col]) {
            $moves[] = [$row + $direction, $col];
        }
        // Gerakan awal dua langkah
        if (($piece->color === 'white' && $row === 6) || ($piece->color === 'black' && $row === 1)) {
            if (!$board[$row + $direction][$col] && !$board[$row + 2 * $direction][$col]) {
                $moves[] = [$row + 2 * $direction, $col];
            }
        }
    }
    // Implementasi gerakan bidak lainnya bisa ditambahkan di sini
    
    return $moves;
}

function isValidMove($fromRow, $fromCol, $toRow, $toCol, $board) {
    $validMoves = getValidMoves($fromRow, $fromCol, $board);
    foreach ($validMoves as $move) {
        if ($move[0] === $toRow && $move[1] === $toCol) {
            return true;
        }
    }
    return false;
}

function isInBoard($row, $col) {
    return $row >= 0 && $row < 8 && $col >= 0 && $col < 8;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chess Game</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .board {
            display: inline-grid;
            grid-template-columns: repeat(8, 60px);
            grid-template-rows: repeat(8, 60px);
            gap: 1px;
            padding: 10px;
            background-color: #333;
            border-radius: 5px;
        }
        .cell {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            background-color: white;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .cell:hover {
            background-color: #e0e0e0;
        }
        .black {
            background-color: #b58863;
        }
        .black:hover {
            background-color: #9e7b5b;
        }
        .selected {
            background-color: #7b61ff !important;
        }
        .valid-move {
            background-color: #90EE90 !important;
        }
        .status {
            margin: 20px 0;
            font-size: 24px;
        }
        .reset-btn {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .reset-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chess Game</h1>
        
        <div class="status">
            Giliran: <?php echo ucfirst($_SESSION['current_player']); ?>
        </div>

        <form method="post">
            <div class="board">
                <?php for ($row = 0; $row < 8; $row++): ?>
                    <?php for ($col = 0; $col < 8; $col++): ?>
                        <?php
                        $isBlack = ($row + $col) % 2 === 1;
                        $isSelected = $_SESSION['selected_piece'] && 
                                    $_SESSION['selected_piece'][0] === $row && 
                                    $_SESSION['selected_piece'][1] === $col;
                        $isValidMove = false;
                        foreach ($_SESSION['valid_moves'] as $move) {
                            if ($move[0] === $row && $move[1] === $col) {
                                $isValidMove = true;
                                break;
                            }
                        }
                        $piece = $_SESSION['chess_board'][$row][$col];
                        ?>
                        <button type="submit" 
                                name="position" 
                                value="<?php echo $row . ',' . $col; ?>"
                                class="cell <?php echo $isBlack ? 'black' : ''; ?> 
                                           <?php echo $isSelected ? 'selected' : ''; ?>
                                           <?php echo $isValidMove ? 'valid-move' : ''; ?>">
                            <?php echo $piece ? $piece->symbol : ''; ?>
                        </button>
                    <?php endfor; ?>
                <?php endfor; ?>
            </div>
            
            <button type="submit" name="reset" class="reset-btn">Reset Game</button>
        </form>
    </div>
</body>
</html>