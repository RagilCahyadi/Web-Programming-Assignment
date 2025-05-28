<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelipatan Angka</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px 0;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
        }

        .multiplication-canvas {
            width: 700px;
            margin: 0 auto;
            padding: 30px;
            background-color: #f0f0f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-container label {
            font-weight: 500;
            color: #333;
            font-size: 1em;
        }

        .form-container input[type="number"] {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
            font-size: 1em;
            width: 200px;
        }

        .form-container input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }

        .form-container input[type="submit"] {
            padding: 9px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 1em;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .warning-message {
            color: red;
            text-align: center;
            margin-top:0;
            margin-bottom: 15px;
            font-size: 0.9em;
            font-weight: 500;
        }

        .title {
            font-size: 1.6em;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
            text-align: left;
        }

        canvas {
            width: 100%;
            border: 1px solid #333;
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $kelipatanInputValue = '';
    $currentKelipatanFactor = 1;
    $warningMessage = "";

    if (!isset($_SESSION['lastValidKelipatanFactor'])) {
        $_SESSION['lastValidKelipatanFactor'] = 1;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputStr = trim($_POST['kelipatan']);
        $kelipatanInputValue = $inputStr;

        if ($inputStr === '') {
            $currentKelipatanFactor = 1;
            $_SESSION['lastValidKelipatanFactor'] = 1;
            $warningMessage = "";
        } else {
            if (filter_var($inputStr, FILTER_VALIDATE_INT) !== false) {
                $inputInt = (int)$inputStr;
                if ($inputInt >= 1 && $inputInt <= 40) {
                    $currentKelipatanFactor = $inputInt;
                    $_SESSION['lastValidKelipatanFactor'] = $inputInt;
                    $warningMessage = "";
                } else {
                    $warningMessage = "Masukkan angka antara 1 dan 40.";
                    $currentKelipatanFactor = $_SESSION['lastValidKelipatanFactor'];
                }
            } else {
                $warningMessage = "Input harus berupa angka.";
                $currentKelipatanFactor = $_SESSION['lastValidKelipatanFactor'];
            }
        }
        $_SESSION['userHasInteracted'] = true;
    } else {
        $currentKelipatanFactor = $_SESSION['lastValidKelipatanFactor'];
        if ($currentKelipatanFactor == 1 && !isset($_SESSION['userHasInteracted'])) {
            $kelipatanInputValue = '';
        } else {
            $kelipatanInputValue = (string)$currentKelipatanFactor;
        }
    }
    ?>

    <div class="multiplication-canvas">
        <div class="form-container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="kelipatan">Masukan Kelipatan :</label>
                <input type="number" id="kelipatan" name="kelipatan"
                       value="<?php echo htmlspecialchars($kelipatanInputValue); ?>"
                       placeholder="Angka (1-40)">
                <input type="submit" value="Kirim">
            </form>
        </div>

        <?php if (!empty($warningMessage)): ?>
            <p class="warning-message"><?php echo htmlspecialchars($warningMessage); ?></p>
        <?php endif; ?>

        <div class="title">Kelipatan dari <?php echo htmlspecialchars($currentKelipatanFactor); ?></div>

        <canvas id="kelipatanCanvas" width="700" height="1300"></canvas>
    </div>

    <script>
        const canvasElement = document.getElementById('kelipatanCanvas');
        const context = canvasElement.getContext('2d');
        const kelipatanFactor = <?php echo $currentKelipatanFactor; ?>;

        const baseCanvasWidth = 700;
        const baseCanvasHeight = 1300;

        const cellWidthBase = baseCanvasWidth / 2;
        const headerHeightBase = 40;
        const rowHeightBase = (baseCanvasHeight - headerHeightBase) / 40;

        function setupCanvas() {
            const dpr = window.devicePixelRatio || 1;
            const htmlCanvasWidth = parseInt(canvasElement.getAttribute('width')) || baseCanvasWidth;
            const htmlCanvasHeight = parseInt(canvasElement.getAttribute('height')) || baseCanvasHeight;

            canvasElement.width = htmlCanvasWidth * dpr;
            canvasElement.height = htmlCanvasHeight * dpr;

            canvasElement.style.width = `${htmlCanvasWidth}px`;
            canvasElement.style.height = `${htmlCanvasHeight}px`;

            context.scale(dpr, dpr);
        }

        function drawTable() {
            context.clearRect(0, 0, baseCanvasWidth, baseCanvasHeight);

            context.fillStyle = '#e9ecef';
            context.fillRect(0, 0, baseCanvasWidth, headerHeightBase);

            context.strokeStyle = '#cccccc';
            context.lineWidth = 1;
            context.strokeRect(0, 0, baseCanvasWidth, headerHeightBase);
            context.beginPath();
            context.moveTo(cellWidthBase * 0.4, 0);
            context.lineTo(cellWidthBase * 0.4, headerHeightBase);
            context.stroke();

            context.fillStyle = '#333';
            context.font = 'bold 14px Poppins';
            context.textAlign = 'center';
            context.textBaseline = 'middle';

            context.fillText('Angka', (cellWidthBase * 0.4) / 2, headerHeightBase / 2);
            context.fillText('Kelipatan', cellWidthBase * 0.4 + (cellWidthBase * 1.6) / 2, headerHeightBase / 2);

            for (let i = 1; i <= 40; i++) {
                const yPos = headerHeightBase + ((i - 1) * rowHeightBase);
                const isMultiple = (kelipatanFactor > 0 && i % kelipatanFactor == 0);

                context.fillStyle = '#f8f9fa';
                context.fillRect(0, yPos, cellWidthBase * 0.4, rowHeightBase);

                if (isMultiple) {
                    context.fillStyle = '#d4ffd2';
                } else {
                    context.fillStyle = '#ffffff';
                }
                context.fillRect(cellWidthBase * 0.4, yPos, cellWidthBase * 1.6, rowHeightBase);

                context.strokeStyle = '#dee2e6';
                context.lineWidth = 1;
                context.strokeRect(0, yPos, cellWidthBase * 0.4, rowHeightBase);
                context.strokeRect(cellWidthBase * 0.4, yPos, cellWidthBase * 1.6, rowHeightBase);
                context.strokeRect(0,yPos, baseCanvasWidth, rowHeightBase);

                context.fillStyle = '#212529';
                context.font = '14px Poppins';
                context.textAlign = 'center';
                context.textBaseline = 'middle';

                context.fillText(i.toString(), (cellWidthBase * 0.4) / 2, yPos + rowHeightBase / 2);

                if (isMultiple) {
                    const textOutput = i + " (kelipatan dari " + kelipatanFactor + ")";
                    context.fillText(textOutput, cellWidthBase * 0.4 + (cellWidthBase * 1.6) / 2, yPos + rowHeightBase / 2);
                } else {
                    context.fillText(i.toString(), cellWidthBase * 0.4 + (cellWidthBase * 1.6) / 2, yPos + rowHeightBase / 2);
                }
            }
        }

        function initializeAndDraw() {
            setupCanvas();
            drawTable();
        }

        if (document.fonts) {
            document.fonts.load('14px Poppins').then(function () {
                document.fonts.load('bold 14px Poppins').then(function () {
                    initializeAndDraw();
                }).catch(function(e){
                    console.error("Font bold Poppins loading error for canvas:", e);
                    initializeAndDraw();
                });
            }).catch(function(e){
                 console.error("Font Poppins loading error for canvas:", e);
                 initializeAndDraw();
            });
        } else {
            setTimeout(initializeAndDraw, 200);
        }
    </script>

</body>
</html>
