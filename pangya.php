<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jogo da Velha</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        #board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-gap: 10px;
            margin: 20px auto;
            width: 320px;
        }

        .cell {
            width: 100px;
            height: 100px;
            border: 2px solid #333;
            font-size: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        #message {
            font-size: 24px;
            margin: 10px;
            color: #333;
        }

        #reset {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Jogo da Velha</h1>
    <div id="board">
        <div class="cell" onclick="makeMove(this)"></div>
        <div class="cell" onclick="makeMove(this)"></div>
        <div class="cell" onclick="makeMove(this)"></div>
        <div class="cell" onclick="makeMove(this)"></div>
        <div class="cell" onclick="makeMove(this)"></div>
        <div class="cell" onclick="makeMove(this)"></div>
        <div class="cell" onclick="makeMove(this)"></div>
        <div class="cell" onclick="makeMove(this)"></div>
        <div class="cell" onclick="makeMove(this)"></div>
    </div>
    <div id="message">É a vez do jogador X</div>
    <button id="reset" onclick="resetBoard()">Reiniciar Jogo</button>
    <script>
        let currentPlayer = "X";
        let board = ["", "", "", "", "", "", "", "", ""];
        let gameActive = true;

        function makeMove(cell) {
            const cellIndex = Array.from(cell.parentNode.children).indexOf(cell);
            if (board[cellIndex] === "" && gameActive) {
                board[cellIndex] = currentPlayer;
                cell.textContent = currentPlayer;
                cell.style.color = (currentPlayer === "X") ? "#FF5733" : "#33FF33";
                checkWinner();
                togglePlayer();
            }
        }

        function togglePlayer() {
            currentPlayer = (currentPlayer === "X") ? "O" : "X";
            document.getElementById("message").textContent = `É a vez do jogador ${currentPlayer}`;
        }

        function checkWinner() {
            const winningCombos = [
                [0, 1, 2], [3, 4, 5], [6, 7, 8],
                [0, 3, 6], [1, 4, 7], [2, 5, 8],
                [0, 4, 8], [2, 4, 6]
            ];

            for (const combo of winningCombos) {
                const [a, b, c] = combo;
                if (board[a] && board[a] === board[b] && board[a] === board[c]) {
                    document.getElementById("message").textContent = `O jogador ${currentPlayer} venceu!`;
                    gameActive = false;
                }
            }

            if (board.every(cell => cell !== "")) {
                document.getElementById("message").textContent = "O jogo empatou!";
                gameActive = false;
            }
        }

        function resetBoard() {
            currentPlayer = "X";
            board = ["", "", "", "", "", "", "", "", ""];
            gameActive = true;
            document.getElementById("message").textContent = `É a vez do jogador ${currentPlayer}`;

            const cells = document.querySelectorAll(".cell");
            cells.forEach(cell => {
                cell.textContent = "";
                cell.style.color = "#333";
            });
        }
    </script>
</body>
</html>
