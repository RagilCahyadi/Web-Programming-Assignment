<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: url('https://static.vecteezy.com/system/resources/previews/024/031/869/non_2x/seascape-sunset-lo-fi-chill-wallpaper-sunrise-ocean-waves-ocean-coast-sun-and-sand-2d-cartoon-landscape-illustration-vaporwave-background-80s-retro-album-art-synthwave-aesthetics-vector.jpg');
            background-size: cover;
            background-position: center;
            padding: 15px; 
            box-sizing: border-box;
        }
        .calendar-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px; 
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12); 
            text-align: center;
            width: 100%; 
            max-width: 520px; 
            box-sizing: border-box;
        }
        .month-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px; 
            padding: 0 5px; 
        }
        .month-header a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500; 
            padding: 8px 12px; 
            border-radius: 6px; 
            transition: background-color 0.25s ease, color 0.25s ease, transform 0.15s ease;
            font-size: 0.8em; 
        }
        .month-header a:hover {
            background-color: #007bff;
            color: #ffffff;
            transform: translateY(-2px); 
        }
        .month-header a:active {
            transform: translateY(0px); 
        }
        .month-header h2 {
            margin: 0 8px; 
            font-size: clamp(1em, 3.5vw, 1.4em); 
            color: #333333;
            font-weight: 600;
            white-space: nowrap;
        }
        #calendarCanvas {
            display: block;
            width: 480px; 
            height: 380px; 
            max-width: 100%; 
            margin: 0 auto; 
        }

        @media (max-width: 520px) { 
             #calendarCanvas {
                width: 100%; 
             }
        }

        @media (max-width: 480px) {
            .month-header h2 {
                font-size: 1em; 
            }
            .month-header a {
                padding: 6px 8px;
                font-size: 0.75em; 
            }
            .calendar-container {
                padding: 15px;
            }
        }
         @media (max-width: 380px) { 
            .month-header h2 {
                font-size: 0.9em;
                margin: 0 5px;
            }
            .month-header a {
                padding: 5px 7px;
                font-size: 0.7em;
            }
        }
    </style>
</head>
<body>
    <?php
        date_default_timezone_set('Asia/Jakarta');

        $todayDayOfMonth = date('d');
        $todayMonth = date('m'); 
        $todayYear = date('Y');

        $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)$todayMonth;
        $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)$todayYear;

        if ($month < 1 || $month > 12) {
            $month = (int)$todayMonth; 
        }
        if ($year < 1970 || $year > 2038) { 
            $year = (int)$todayYear; 
        }

        $monthNames = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $firstDayOfMonthTimestamp = strtotime("$year-$month-01");
        $firstDayOfMonthIndex = (int)date('w', $firstDayOfMonthTimestamp);
        $daysInMonth = (int)date('t', $firstDayOfMonthTimestamp);

        $prevMonthNav = $month - 1;
        $prevYearNav = $year;
        if ($prevMonthNav == 0) { 
            $prevMonthNav = 12;
            $prevYearNav--;
        }
        $prevLink = "?month={$prevMonthNav}&year={$prevYearNav}";

        $nextMonthNav = $month + 1;
        $nextYearNav = $year;
        if ($nextMonthNav == 13) { 
            $nextMonthNav = 1;
            $nextYearNav++;
        }
        $nextLink = "?month={$nextMonthNav}&year={$nextYearNav}";
    ?>

    <div class="calendar-container">
        <div class="month-header">
            <a id="prevMonthLink" href="<?php echo htmlspecialchars($prevLink); ?>">&laquo; Sebelumnya</a>
            <h2><?php echo htmlspecialchars($monthNames[$month]) . ' ' . htmlspecialchars($year); ?></h2>
            <a id="nextMonthLink" href="<?php echo htmlspecialchars($nextLink); ?>">Berikutnya &raquo;</a>
        </div>
        <canvas id="calendarCanvas"></canvas>
    </div>

    <script>
        const canvas = document.getElementById('calendarCanvas');
        const ctx = canvas.getContext('2d');

        const renderMonth = parseInt("<?php echo $month; ?>");
        const renderYear = parseInt("<?php echo $year; ?>");
        const dayNamesFull = <?php echo json_encode($dayNames); ?>; 
        const firstDayOfMonthIndex = parseInt("<?php echo $firstDayOfMonthIndex; ?>");
        const daysInMonth = parseInt("<?php echo $daysInMonth; ?>");

        const todayDate = parseInt("<?php echo $todayDayOfMonth; ?>");
        const todayMonth = parseInt("<?php echo $todayMonth; ?>");
        const todayYear = parseInt("<?php echo $todayYear; ?>");

        const dayNamesHeaderHeight = 50; 
        const dayNameFont = "bold 12px Poppins"; 
        const dateFont = "14px Poppins"; 
        
        const colorBgHighlightRed = "red"; 
        const colorTextHighlightWhite = "#FFFFFF"; 

        const colorTextNormal = "#333333";
        const colorBorder = "#E0E0E0";
        const colorBgCell = "#FFFFFF";
        const colorTextDayName = "#212529"; 
        const colorTextOtherMonth = "#AAAAAA"; 
        const colorBgOtherMonth = "#F8F9FA";   
        const colorBgDayNamesHeader = "#E9ECEF"; 

        function setupCanvas() {
            const dpr = window.devicePixelRatio || 1;
            const style = getComputedStyle(canvas);
            const cssWidth = parseInt(style.width);
            const cssHeight = parseInt(style.height);

            canvas.width = cssWidth * dpr;
            canvas.height = cssHeight * dpr;
            
            canvas.style.width = cssWidth + 'px';
            canvas.style.height = cssHeight + 'px';

            ctx.scale(dpr, dpr);
        }


        function drawCalendar() {
            ctx.clearRect(0, 0, canvas.width / (window.devicePixelRatio || 1), canvas.height / (window.devicePixelRatio || 1));

            const cssWidth = parseInt(canvas.style.width); 
            const cssHeight = parseInt(canvas.style.height);

            const cellWidth = cssWidth / 7;
            const dateGridHeight = cssHeight - dayNamesHeaderHeight; 
            const cellHeight = dateGridHeight / 6; 

            ctx.fillStyle = colorBgDayNamesHeader;
            ctx.fillRect(0, 0, cssWidth, dayNamesHeaderHeight);
            
            ctx.strokeStyle = colorBorder; 
            for (let i = 0; i < dayNamesFull.length; i++) {
                ctx.strokeRect(i * cellWidth, 0, cellWidth, dayNamesHeaderHeight);
            }

            ctx.font = dayNameFont;
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            ctx.fillStyle = colorTextDayName;

            for (let i = 0; i < dayNamesFull.length; i++) {
                ctx.fillText(dayNamesFull[i], (i * cellWidth) + (cellWidth / 2), dayNamesHeaderHeight / 2);
            }

            const prevMonthDateObject = new Date(renderYear, renderMonth - 1, 0);
            const daysInPrevMonth = prevMonthDateObject.getDate();
            let prevMonthDayToDisplay = daysInPrevMonth - firstDayOfMonthIndex + 1;

            let nextMonthDayToDisplay = 1;
            let currentMonthDayCounter = 1;

            ctx.font = dateFont;

            for (let row = 0; row < 6; row++) {
                for (let col = 0; col < 7; col++) {
                    const x = col * cellWidth;
                    const y = dayNamesHeaderHeight + (row * cellHeight);
                    let dayToDraw;
                    
                    let currentCellBackgroundColor = colorBgCell;
                    let currentCellTextColor = colorTextNormal;

                    if (row === 0 && col < firstDayOfMonthIndex) {
                        dayToDraw = prevMonthDayToDisplay;
                        prevMonthDayToDisplay++;
                        currentCellBackgroundColor = colorBgOtherMonth;
                        currentCellTextColor = colorTextOtherMonth;
                    } else if (currentMonthDayCounter > daysInMonth) {
                        dayToDraw = nextMonthDayToDisplay;
                        nextMonthDayToDisplay++;
                        currentCellBackgroundColor = colorBgOtherMonth;
                        currentCellTextColor = colorTextOtherMonth;
                    } else {
                        dayToDraw = currentMonthDayCounter;
                        currentMonthDayCounter++;

                        const isTodayExactDate = (dayToDraw === todayDate && renderMonth === todayMonth && renderYear === todayYear);
                        const isSameDayNumberAsToday = (dayToDraw === todayDate);

                        if (isTodayExactDate) {
                            currentCellBackgroundColor = colorBgHighlightRed;
                            currentCellTextColor = colorTextHighlightWhite;
                        } else if (isSameDayNumberAsToday) {
                            currentCellBackgroundColor = colorBgHighlightRed;
                            currentCellTextColor = colorTextHighlightWhite;
                        }
                    }
                    
                    ctx.fillStyle = currentCellBackgroundColor;
                    ctx.fillRect(x + 0.5, y + 0.5, cellWidth - 1, cellHeight - 1);

                    ctx.strokeStyle = colorBorder;
                    ctx.strokeRect(x, y, cellWidth, cellHeight);

                    ctx.fillStyle = currentCellTextColor;
                    ctx.fillText(dayToDraw.toString(), x + (cellWidth / 2), y + (cellHeight / 2));
                }
            }
        }
        
        function initializeCalendar() {
            setupCanvas(); 
            drawCalendar();
        }

        window.onload = function() {
            if (document.fonts && typeof document.fonts.ready === 'object') {
                document.fonts.ready.then(function() {
                    initializeCalendar();
                }).catch(function(error) {
                    console.error('Font loading error:', error);
                    initializeCalendar(); 
                });
            } else {
                setTimeout(initializeCalendar, 50); 
            }
        };
    </script>
</body>
</html>