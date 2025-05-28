<?php
$defaultChartData = [
    'labels' => ["January", "February", "March", "April", "May"],
    'data' => [10, 20, 15, 25, 30]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);

    $currentLabels = $input['currentLabels'] ?? [];
    $currentData = $input['currentData'] ?? [];
    $newLabel = $input['newLabel'] ?? '';
    $newValue = $input['newValue'] ?? null;

    $response = ['success' => false, 'message' => ''];

    if (empty($newLabel) || $newValue === null || !is_numeric($newValue)) {
        $response['message'] = 'Label and Value are required, and Value must be numeric.';
    } elseif ((float)$newValue < 1) {
        $response['message'] = 'Value must be at least 1.';
    } else {
        $currentLabels[] = $newLabel;
        $currentData[] = (float)$newValue;

        $response['success'] = true;
        $response['labels'] = $currentLabels;
        $response['data'] = $currentData;
        $response['message'] = 'Data processed for current view.';
    }
    echo json_encode($response);
    exit;
}

$initialLabelsJSON = json_encode($defaultChartData['labels']);
$initialDataJSON = json_encode($defaultChartData['data']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Chart</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #ffffff;
            margin: 20px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 800px;
        }

        .form-container {
            margin-bottom: 25px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
        }

        .form-container input[type="text"],
        .form-container input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            min-width: 150px;
        }

        .form-container button {
            cursor: pointer;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .chart-container {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 4px;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
            width: 100%;
            box-sizing: border-box;
        }

        canvas {
            display: block;
            max-width: 100%;
            height: auto;
        }

        #messageDisplay {
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            min-height: 40px;
            margin-bottom: 20px;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        #messageDisplay.visible {
            visibility: visible;
            opacity: 1;
        }
        #messageDisplay.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        #messageDisplay.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

    </style>
</head>

<body>
    <div class="container">
        <h2>Dynamic Chart</h2>
        <div class="form-container">
            <input type="text" id="labelInput" placeholder="Enter Label">
            <input type="number" id="valueInput" placeholder="Enter Value" min="1">
            <button id="addDataBtn">Add Data</button>
        </div>
        <div id="messageDisplay"></div>
        <div class="chart-container">
            <canvas id="myChart" width="700" height="400"></canvas>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('myChart');
            const ctx = canvas.getContext('2d');
            const labelInput = document.getElementById('labelInput');
            const valueInput = document.getElementById('valueInput');
            const addDataBtn = document.getElementById('addDataBtn');
            const messageDisplay = document.getElementById('messageDisplay');

            let labels = <?php echo $initialLabelsJSON; ?>;
            let data = <?php echo $initialDataJSON; ?>;

            function showUserMessage(message, type = 'error') {
                messageDisplay.textContent = message;
                messageDisplay.className = type;
                messageDisplay.classList.add('visible');
            }

            function hideUserMessage() {
                messageDisplay.classList.remove('visible');
                messageDisplay.textContent = '';
            }


            function drawChart() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                const padding = 50;
                const chartWidth = canvas.width - 2 * padding;
                const chartHeight = canvas.height - 2 * padding;

                ctx.beginPath();
                ctx.lineWidth = 1;
                ctx.strokeStyle = '#333';
                ctx.moveTo(padding, padding);
                ctx.lineTo(padding, canvas.height - padding);
                ctx.lineTo(canvas.width - padding, canvas.height - padding);
                ctx.stroke();

                if (data.length === 0) {
                    ctx.fillStyle = '#777';
                    ctx.font = '16px Arial';
                    ctx.textAlign = 'center';
                    ctx.fillText("No data to display", canvas.width / 2, canvas.height / 2);
                    return;
                }

                const maxValue = Math.max(0, ...data);
                const yAxisScale = chartHeight / (maxValue > 0 ? maxValue * 1.1 : 10);

                ctx.fillStyle = '#333';
                ctx.font = '10px Arial';
                ctx.textAlign = 'right';
                const numYLabels = 5;
                for (let i = 0; i <= numYLabels; i++) {
                    const yValue = maxValue > 0 ? (maxValue / numYLabels) * i : (10 / numYLabels) * i;
                    const yPos = canvas.height - padding - (yValue * yAxisScale);
                    if (Number.isFinite(yValue)) {
                        ctx.fillText(Math.round(yValue), padding - 8, yPos + 3);
                    }
                    if (i > 0 || (maxValue === 0 && i === 0)) {
                        ctx.beginPath();
                        ctx.strokeStyle = '#e0e0e0';
                        ctx.lineWidth = 0.5;
                        ctx.moveTo(padding + 1, yPos);
                        ctx.lineTo(canvas.width - padding, yPos);
                        ctx.stroke();
                    }
                }
                ctx.beginPath(); 
                ctx.lineWidth = 1; ctx.strokeStyle = '#333';
                ctx.moveTo(padding, canvas.height - padding);
                ctx.lineTo(canvas.width - padding, canvas.height - padding);
                ctx.stroke();

                ctx.textAlign = 'center';
                ctx.font = '10px Arial';
                ctx.fillStyle = '#333';
                if (labels.length > 0) {
                    const getXPosition = (index, count) => {
                        if (count === 1) return padding + chartWidth / 2;
                        return padding + (chartWidth / (count - 1)) * index;
                    };
                    labels.forEach((label, index) => {
                        const xPos = getXPosition(index, labels.length);
                        ctx.fillText(label, xPos, canvas.height - padding + 15);
                    });
                }

                if (data.length > 0) {
                    const getDataXPosition = (index, count) => {
                        if (count === 1) return padding + chartWidth / 2;
                        return padding + (chartWidth / (count - 1)) * index;
                    };
                    if (data.length > 1) {
                        ctx.beginPath();
                        ctx.strokeStyle = 'blue';
                        ctx.lineWidth = 2;
                        data.forEach((value, index) => {
                            const x = getDataXPosition(index, data.length);
                            const y = canvas.height - padding - (value * yAxisScale);
                            if (index === 0) ctx.moveTo(x, y);
                            else ctx.lineTo(x, y);
                        });
                        ctx.stroke();
                    }
                    ctx.fillStyle = 'blue';
                    data.forEach((value, index) => {
                        const x = getDataXPosition(index, data.length);
                        const y = canvas.height - padding - (value * yAxisScale);
                        ctx.beginPath();
                        ctx.arc(x, y, 4, 0, Math.PI * 2);
                        ctx.fill();
                    });
                }
            }

            drawChart(); 

            addDataBtn.addEventListener('click', () => {
                hideUserMessage();
                const newLabelToAdd = labelInput.value.trim();
                const newValueString = valueInput.value.trim();
                let newValueToAdd;

                if (!newLabelToAdd || newValueString === '') {
                    showUserMessage('Please enter both a label and a value.', 'error');
                    return;
                }
                newValueToAdd = parseFloat(newValueString);
                if (isNaN(newValueToAdd)) {
                    showUserMessage('Value must be a valid number.', 'error');
                    return;
                }
                if (newValueToAdd < 1) {
                    showUserMessage('Value must be at least 1.', 'error');
                    return;
                }


                addDataBtn.disabled = true;
                addDataBtn.textContent = 'Processing...';

                fetch('<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>', { 
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest' 
                    },
                    body: JSON.stringify({
                        currentLabels: labels,    
                        currentData: data,        
                        newLabel: newLabelToAdd,  
                        newValue: newValueToAdd   
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                           throw new Error(`HTTP error! status: ${response.status}, message: ${text}`);
                        });
                    }
                    return response.json();
                })
                .then(result => {
                    if (result.success) {
                        labels = result.labels; 
                        data = result.data;     
                        drawChart();
                        labelInput.value = ''; 
                        valueInput.value = '';
                    } else {
                        showUserMessage(result.message || 'Failed to process data via PHP.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showUserMessage('An error occurred: ' + error.message, 'error');
                })
                .finally(() => {
                    addDataBtn.disabled = false;
                    addDataBtn.textContent = 'Add Data';
                });
            });
        });
    </script>
</body>
</html>
