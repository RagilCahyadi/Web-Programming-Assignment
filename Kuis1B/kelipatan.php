<?php
$kelipatan_input_str = '';
$judul_kelipatan_display_angka = 1;
$faktor_kelipatan_aktif = 1;
$semua_baris_hijau = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kelipatan_input_str = isset($_POST['kelipatan']) ? htmlspecialchars(trim($_POST['kelipatan'])) : '';

    if ($kelipatan_input_str === '') {
        $judul_kelipatan_display_angka = 1;
        $faktor_kelipatan_aktif = 1;
        $semua_baris_hijau = true;
    } elseif (!is_numeric($kelipatan_input_str)) {
        $judul_kelipatan_display_angka = 1;
        $faktor_kelipatan_aktif = 1;
        $semua_baris_hijau = true;
        $kelipatan_input_str = '';
    } else {
        $angka_input_numerik = intval($kelipatan_input_str);

        if ($angka_input_numerik < 1) {
            $judul_kelipatan_display_angka = 1;
            $faktor_kelipatan_aktif = 1;
            $semua_baris_hijau = true;
        } elseif ($angka_input_numerik > 40) {
            $judul_kelipatan_display_angka = 1;
            $faktor_kelipatan_aktif = 1;
            $semua_baris_hijau = true;
        } else {
            $judul_kelipatan_display_angka = $angka_input_numerik;
            $faktor_kelipatan_aktif = $angka_input_numerik;
            $semua_baris_hijau = false;
        }
    }
} else {
    $judul_kelipatan_display_angka = 1;
    $faktor_kelipatan_aktif = 1;
    $semua_baris_hijau = true;
}

$judul_tabel_dinamis = "Kelipatan dari " . $judul_kelipatan_display_angka;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelipatan Angka</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            display: flex;
            justify-content: center; 
            align-items: flex-start; 
            min-height: 100vh;
            padding-top: 30px;
            padding-bottom: 30px;
            box-sizing: border-box;
        }

        .canvas-container { 
            width: 700px; 
            max-width: 90%; 
            background-color: #f0f0f0;
            padding: 30px; 
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #cccccc;
            box-sizing: border-box; 
            text-align: center; 
        }

        .form-container {
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }

        .form-container label {
            font-weight: 600;
            color: #333;
            font-size: 1.1em;
        }

        .form-container input[type="number"] {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            font-size: 1em;
            width: 120px;
            text-align: center;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
            outline: none;
        }

        .form-container input[type="submit"] {
            padding: 12px 25px;
            border-radius: 8px;
            background-image: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: background-image 0.3s ease, transform 0.2s ease;
        }

        .form-container input[type="submit"]:hover {
            background-image: linear-gradient(to right, #0056b3, #004085);
            transform: translateY(-2px);
        }
        .form-container input[type="submit"]:active {
            transform: translateY(0px);
        }

        .judul-tabel {
            font-size: 1.8em;
            color: #0056b3;
            margin-bottom: 20px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            table-layout: fixed;
        }

        th, td {
            border: none;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            word-wrap: break-word;
        }
        
        tr:last-child td {
            border-bottom: none;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            font-size: 1.1em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        th:first-child {
            border-top-left-radius: 8px;
            width: 30%;
        }
        th:last-child {
            border-top-right-radius: 8px;
        }

        .bg-green {
            background-color: #d4edda;
            color: #155724;
            font-weight: 600;
        }

        .bg-white {
            background-color: #ffffff;
            color: #333;
        }

        tbody tr:nth-child(even) td:not(.bg-green) {
             background-color: #f8f9fa;
        }
        tbody tr:nth-child(odd) td:not(.bg-green) {
             background-color: #ffffff;
        }

    </style>
</head>
<body>
    <div class="canvas-container"> 
        <div class="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="kelipatan">Masukan Kelipatan:</label>
                <input type="number" id="kelipatan" name="kelipatan" value="<?php echo $kelipatan_input_str; ?>" placeholder="Angka(1 - 40)" min="1" max="40">
                <input type="submit" value="Kirim">
            </form>
        </div>

        <h2 class="judul-tabel"><?php echo $judul_tabel_dinamis; ?></h2>

        <table>
            <thead>
                <tr>
                    <th>Angka</th>
                    <th>Kelipatan</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 40; $i++): ?>
                    <?php
                    $kelas_background_sel = '';
                    $teks_kelipatan_display = $i;

                    if ($semua_baris_hijau) {
                        $kelas_background_sel = 'bg-green';
                        $teks_kelipatan_display = $i . " (Kelipatan dari " . $faktor_kelipatan_aktif . ")";
                    } elseif ($faktor_kelipatan_aktif > 0 && $i % $faktor_kelipatan_aktif == 0) {
                        $kelas_background_sel = 'bg-green';
                        $teks_kelipatan_display = $i . " (Kelipatan dari " . $faktor_kelipatan_aktif . ")";
                    }
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>  
                        <td class="<?php echo $kelas_background_sel; ?>"><?php echo $teks_kelipatan_display; ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
