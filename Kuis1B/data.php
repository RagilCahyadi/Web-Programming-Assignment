<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Menggunakan font system untuk tampilan yang lebih modern */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f7f6; /* Latar belakang yang lebih lembut */
            padding: 20px;
            box-sizing: border-box;
        }

        .main-content-wrapper {
            width: 100%; /* Menggunakan lebar penuh hingga max-width */
            max-width: 700px; /* Batasi lebar maksimum */
            min-height: 450px; /* Memberikan sedikit lebih banyak tinggi */
            background-color: #ffffff; /* Latar belakang putih bersih */
            padding: 25px; /* Padding sedikit lebih besar */
            border-radius: 8px; /* Sudut yang sedikit membulat */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bayangan yang lebih lembut dan terlihat */
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
        }

        .form-input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px; /* Jarak antar elemen form */
            margin-bottom: 25px; /* Jarak di bawah form */
            width: 100%; /* Mengambil lebar penuh kontainer */
            max-width: 500px; /* Batasi lebar form untuk penataan */
            flex-wrap: wrap; /* Memungkinkan elemen form untuk 'wrap' pada layar kecil */
        }

        .form-input-container input[type="text"],
        .form-input-container input[type="number"] {
            flex-grow: 1; /* Memungkinkan input untuk memanjang mengisi ruang */
            width: auto; /* Override width tetap */
            min-width: 150px; /* Minimum lebar untuk input */
            padding: 10px 12px; /* Padding yang lebih baik di dalam input */
            border: 1px solid #dcdcdc; /* Border yang lebih halus */
            border-radius: 4px; /* Sudut membulat untuk input */
            font-size: 1em; /* Ukuran font yang sedikit lebih besar */
            box-sizing: border-box;
            transition: border-color 0.2s ease-in-out; /* Transisi halus saat fokus */
        }

         .form-input-container input::placeholder {
            color: #a9a9a9; /* Warna placeholder */
         }

        .form-input-container input:focus {
            outline: none; /* Hapus outline default */
            border-color: #007bff; /* Warna border saat fokus */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Efek bayangan saat fokus */
        }

        .form-input-container button {
            padding: 10px 20px; /* Padding yang lebih baik untuk tombol */
            background-color: #007bff; /* Warna biru primer untuk tombol */
            color: white; /* Warna teks putih */
            border: none; /* Hapus border default */
            border-radius: 4px; /* Sudut membulat untuk tombol */
            cursor: pointer;
            font-size: 1em; /* Ukuran font yang konsisten */
            font-weight: bold; /* Teks tebal */
            transition: background-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out; /* Transisi halus saat hover */
        }

        .form-input-container button:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Bayangan ringan saat hover */
        }

         .form-input-container button:active {
            background-color: #004085; /* Warna biru saat ditekan */
             box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2); /* Efek tertekan */
         }


        .chart-canvas-area {
            width: 100%;
            flex-grow: 1; /* Memungkinkan area grafik mengambil sisa ruang */
            background-color: #ffffff; /* Latar belakang putih untuk area grafik */
            box-sizing: border-box;
            position: relative;
        }

        /* Memastikan canvas mengambil 100% lebar dan tinggi dari parent-nya */
        .chart-canvas-area canvas {
             width: 100% !important;
             height: 100% !important;
             display: block; /* Menghilangkan spasi ekstra di bawah canvas */
        }
    </style>
</head>

<body>

    <div class="main-content-wrapper">
        <!-- Struktur form tidak diubah, termasuk onsubmit, id, dan teks tombol -->
        <form class="form-input-container" onsubmit="handleSubmit(event)">
            <input
                type="text"
                id="newLabel"
                placeholder="Label"
                required>
            <input
                type="number"
                id="newValue"
                placeholder="Value"
                required>
            <button type="submit">Add Data</button>
        </form>

        <div class="chart-canvas-area">
            <!-- Canvas tetap dengan id yang sama -->
            <canvas id="myDynamicChart"></canvas>
        </div>
    </div>

    <script>
        // Kode JavaScript tetap sama persis seperti aslinya,
        // hanya opsi visual Chart.js yang disesuaikan.

        const initialLabels = ["January", "February", "March", "April", "May"];
        const initialDataValues = [10, 20, 15, 25, 30];

        const chartContext = document.getElementById('myDynamicChart').getContext('2d');
        const dynamicChart = new Chart(chartContext, {
            type: 'line',
            data: {
                labels: [...initialLabels],
                datasets: [{
                    data: [...initialDataValues],
                    borderColor: '#007bff', // Warna garis dipercantik menjadi biru
                    backgroundColor: 'rgba(0, 0, 255, 0)', // Tetap transparan (fungsi asli)
                    tension: 0.2, // Garis sedikit melengkung untuk estetika
                    borderWidth: 2,
                    pointRadius: 4, // Membuat titik data terlihat
                    pointBackgroundColor: '#007bff', // Warna titik
                    pointBorderColor: '#ffffff', // Border putih di sekitar titik
                    pointHoverRadius: 6, // Ukuran titik saat di-hover
                    pointHoverBackgroundColor: '#0056b3', // Warna titik saat di-hover
                    pointHoverBorderColor: '#ffffff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                         // Padding di dalam area chart - disesuaikan
                        top: 20,
                        right: 20,
                        bottom: 0,
                        left: 0
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        border: {
                            display: true,
                            color: '#e0e0e0' /* Warna border sumbu yang lebih halus */
                        },
                         grid: {
                             display: true, /* Tampilkan garis grid Y */
                             color: '#f0f0f0', /* Warna garis grid yang sangat halus */
                             drawBorder: false /* Jangan gambar border grid */
                         },
                        ticks: {
                            stepSize: 5,
                            font: {
                                size: 10 /* Ukuran font tick */
                            },
                            color: '#666666',
                            padding: 8 /* Padding tick */
                        }
                    },
                    x: {
                        border: {
                            display: true,
                            color: '#e0e0e0' /* Warna border sumbu yang lebih halus */
                        },
                        grid: {
                            display: false /* Sembunyikan garis grid X */
                        },
                        ticks: {
                            font: {
                                size: 10 /* Ukuran font tick */
                            },
                            color: '#666666',
                            padding: 8 /* Padding tick */
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0,0,0,0.85)', /* Latar belakang tooltip lebih gelap */
                        titleFont: {
                            size: 12, /* Ukuran font judul tooltip */
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 11 /* Ukuran font body tooltip */
                        },
                        padding: 8, /* Padding tooltip */
                        displayColors: true, /* Tampilkan swatch warna di tooltip */
                        // Callback label tetap seperti asli
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y !== null ? '' + context.parsed.y : '';
                            },
                            // Menambah callback title untuk tampilan tooltip yang lebih baik (visual)
                             title: function(context) {
                                 return context[0].label; // Menggunakan label X sebagai judul
                             }
                        }
                    }
                },
                animation: {
                    duration: 600, /* Durasi animasi sedikit lebih panjang */
                    easing: 'easeOutQuart' /* Efek easing yang lebih halus */
                },
                hover: { // Menambah opsi hover untuk interaksi yang lebih baik
                    mode: 'nearest',
                    intersect: true
                }
            }
        });

        const newLabelInputElement = document.getElementById('newLabel');
        const newValueInputElement = document.getElementById('newValue');

        // Fungsi handleSubmit tetap sama persis seperti aslinya
        function handleSubmit(event) {
            event.preventDefault();

            const label = newLabelInputElement.value.trim();
            const valueStr = newValueInputElement.value.trim();
            const value = parseFloat(valueStr);

            // Validasi input
            if (!label || !valueStr) {
                return;
            }

            dynamicChart.data.labels.push(label);
            dynamicChart.data.datasets.forEach((dataset) => {
                dataset.data.push(value);
            });
            dynamicChart.update();

            // Reset form
            newLabelInputElement.value = '';
            newValueInputElement.value = '';
            newLabelInputElement.focus();
        }
    </script>

</body>

</html>