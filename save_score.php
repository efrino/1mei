<?php
// Mendapatkan data dari permintaan POST
$data = json_decode(file_get_contents("php://input"), true);

// Mendapatkan isi file results.json
$results = json_decode(file_get_contents("results.json"), true);

// Menambahkan skor baru ke dalam array results
$results[] = $data;

// Mengurutkan hasil berdasarkan skor secara descending
usort($results, function($a, $b) {
    return $b['score'] - $a['score'];
});

// Membatasi hasil menjadi 10 skor teratas
$results = array_slice($results, 0, 10);

// Menyimpan hasil kembali ke dalam file results.json
file_put_contents("results.json", json_encode($results));

// Mengembalikan respons ke klien
header("Content-Type: application/json");
echo json_encode($results);
?>
