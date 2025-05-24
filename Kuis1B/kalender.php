<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

        @keyframes cellRollUp {
            from {
                opacity: 0;
                transform: translateY(20px) scaleY(0.6);
                transform-origin: bottom;
            }
            to {
                opacity: 1;
                transform: translateY(0) scaleY(1);
                transform-origin: bottom;
            }
        }

        @keyframes cellRollDown {
            from {
                opacity: 0;
                transform: translateY(-20px) scaleY(0.6);
                transform-origin: top;
            }
            to {
                opacity: 1;
                transform: translateY(0) scaleY(1);
                transform-origin: top;
            }
        }

        @keyframes pulseToday {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 8px rgba(231, 76, 60, 0.3);
            }
            50% {
                transform: scale(1.07);
                box-shadow: 0 0 12px rgba(231, 76, 60, 0.5);
            }
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', 'Arial', sans-serif;
            background-image: url('https://static.vecteezy.com/system/resources/previews/024/031/869/non_2x/seascape-sunset-lo-fi-chill-wallpaper-sunrise-ocean-waves-ocean-coast-sun-and-sand-2d-cartoon-landscape-illustration-vaporwave-background-80s-retro-album-art-synthwave-aesthetics-vector.jpg');
            background-size: cover;
            background-position: center;
            overflow-x: hidden; 
        }

        .calendar-canvas-wrapper {
            position: relative; 
        }
        
        #calendarDrawingCanvas {
            display: block;
            border: 1px solid #e0e0e0; 
            background-color: rgba(255, 255, 255, 0.97); 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); 
            border-radius: 12px; 
        }

        .calendar-php-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%; 
            height: 100%; 
            padding: 20px; 
            box-sizing: border-box; 
            display: flex;
            flex-direction: column; 
            justify-content: flex-start; 
            align-items: center; 
            text-align: center;
        }
        
        .month-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            width: 100%; 
        }

        .month-header a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            padding: 8px 10px; 
            border-radius: 6px; 
            transition: background-color 0.25s ease, color 0.25s ease, transform 0.2s ease-out, box-shadow 0.2s ease-out; 
            white-space: nowrap; 
            font-size: 0.8em; 
            flex-shrink: 0; 
        }

        .month-header a:hover {
            background-color: #0056b3;
            color: #ffffff;
            transform: translateY(-2px); 
            box-shadow: 0 3px 6px rgba(0,0,0,0.1); 
        }

        .month-header h2 {
            margin: 0 8px; 
            font-size: 1.1em; 
            color: #333;
            font-weight: 600; 
            white-space: nowrap;
            min-width: 0; 
            text-align: center; 
            overflow: hidden; 
            flex-grow: 1; 
        }

        table {
            width: 100%; 
            table-layout: fixed; 
            border-collapse: collapse;
            margin: 0 auto; 
        }

        th, td {
            border: 1px solid #ddd;
            padding: 0; 
            text-align: center;
            height: 45px; 
            line-height: 45px; 
        }

        th {
            background-color: #f0f0f0;
            color: #333;
            font-weight: bold; 
            font-size: 0.9em; 
        }

        td {
            font-size: 0.95em; 
            position: relative; 
            overflow: hidden;
        }
        
        tbody.animate-cells-roll-up td:not(.empty) {
            animation: cellRollUp 0.35s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        tbody.animate-cells-roll-down td:not(.empty) {
            animation: cellRollDown 0.35s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        
        td:not(.empty):not(.today) {
            transition: transform 0.2s cubic-bezier(0.25, 0.1, 0.25, 1.5), 
                        background-color 0.2s ease-out, 
                        box-shadow 0.2s ease-out, 
                        font-weight 0.1s ease-out,
                        color 0.2s ease-out;
        }

        td:not(.empty):not(.today):hover {
            background-color: #007bff; 
            color: white; 
            transform: scale(1.1); 
            font-weight: bold; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.15); 
            z-index: 2; 
            border-radius: 6px; 
        }

        td.empty.previous-month,
        td.empty.next-month {
            color: #cccccc; 
            background-color: #f9f9f9;
        }
        
        td.today {
            background-color: #e74c3c; 
            color: white;
            font-weight: 700;
            border-radius: 8px; 
            position: relative; 
            animation: pulseToday 2.5s infinite ease-in-out; 
            z-index: 1; 
        }

    </style>
</head>
<body>
    <?php
        $tbody_animation_class = '';
        if (isset($_GET['nav'])) {
            if ($_GET['nav'] === 'next') {
                $tbody_animation_class = 'animate-cells-roll-up';
            } elseif ($_GET['nav'] === 'prev') {
                $tbody_animation_class = 'animate-cells-roll-down';
            }
        }

        date_default_timezone_set('Asia/Jakarta');
        $todayDayOfMonth = date('d');
        $todayMonth = date('m');
        $todayYear = date('Y');
        $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)$todayMonth;
        $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)$todayYear;
        if ($month < 1 || $month > 12) { $month = (int)$todayMonth; }
        if ($year < 1970 || $year > 2038) { $year = (int)$todayYear; }
        $disabledDates = [
            date('Y-m-d', strtotime("$year-$month-01 -2 days")), 
            date('Y-m-d', strtotime("$year-$month-01 -5 days")), 
            date('Y-m-d', strtotime(date('Y-m-t', strtotime("$year-$month-01")) . " +1 day")), 
            date('Y-m-d', strtotime(date('Y-m-t', strtotime("$year-$month-01")) . " +3 days")), 
            "2025-01-01", 
            "2025-12-25", 
        ];
        $disabledDates = array_unique($disabledDates); 
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
        $prevLink = "?month={$prevMonthNav}&year={$prevYearNav}&nav=prev";

        $nextMonthNav = $month + 1;
        $nextYearNav = $year;
        if ($nextMonthNav == 13) {
            $nextMonthNav = 1;
            $nextYearNav++;
        }
        $nextLink = "?month={$nextMonthNav}&year={$nextYearNav}&nav=next";
    ?>

    <div class="calendar-canvas-wrapper">
        <canvas id="calendarDrawingCanvas" width="480" height="420"></canvas>
        <div class="calendar-php-content"> 
            <div class="month-header">
                <a href="<?php echo $prevLink; ?>">&laquo; Bulan Sebelumnya</a>
                <h2><?php echo $monthNames[$month] . ' ' . $year; ?></h2>
                <a href="<?php echo $nextLink; ?>">Bulan Berikutnya &raquo;</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <?php foreach ($dayNames as $day): ?>
                            <th><?php echo $day; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody class="<?php echo $tbody_animation_class; ?>">
                    <?php
                        for ($row = 0; $row < 6; $row++) {
                            echo '<tr>';
                            for ($col = 0; $col < 7; $col++) {
                                $cellClasses = [];
                                $cellDisplayContent = '&nbsp;'; 
                                $cellDateStr = ''; 

                                if ($row === 0 && $col < $firstDayOfMonthIndex) {
                                    $daysToSubtract = $firstDayOfMonthIndex - $col;
                                    $dateTimestamp = strtotime("$year-$month-01 -{$daysToSubtract} days");
                                    $cellDateStr = date('Y-m-d', $dateTimestamp);
                                    $cellDisplayContent = date('j', $dateTimestamp);
                                    $cellClasses[] = 'empty';
                                    $cellClasses[] = 'previous-month';
                                } else {
                                    $dayInGrid = ($row * 7) + $col - $firstDayOfMonthIndex + 1;

                                    if ($dayInGrid > 0 && $dayInGrid <= $daysInMonth) {
                                        $cellDateStr = sprintf('%04d-%02d-%02d', $year, $month, $dayInGrid);
                                        $cellDisplayContent = $dayInGrid;
                                        if ($dayInGrid == $todayDayOfMonth) {
                                            $cellClasses[] = 'today';
                                        }
                                    } else if ($dayInGrid > $daysInMonth) {
                                        $daysToAdd = $dayInGrid - $daysInMonth;
                                        $baseDateForNextMonth = strtotime("$year-$month-$daysInMonth");
                                        $dateTimestamp = strtotime("+$daysToAdd days", $baseDateForNextMonth);
                                        $cellDateStr = date('Y-m-d', $dateTimestamp);
                                        $cellDisplayContent = date('j', $dateTimestamp);
                                        $cellClasses[] = 'empty';
                                        $cellClasses[] = 'next-month';
                                    } else {
                                        $cellClasses[] = 'empty';
                                    }
                                }

                                if (in_array('empty', $cellClasses) && !empty($cellDateStr) && in_array($cellDateStr, $disabledDates)) {
                                    $cellClasses[] = 'disabled-date'; 
                                }
                                
                                if (empty($cellClasses) && $cellDisplayContent === '&nbsp;') {
                                    $cellClasses[] = 'empty';
                                }

                                echo '<td class="' . implode(' ', array_unique($cellClasses)) . '">' . $cellDisplayContent . '</td>';
                            }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
