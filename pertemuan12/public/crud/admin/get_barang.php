<?php
require_once __DIR__ . '/../../../app/classes/database.php';

header('Content-Type: application/json');

try {
    $database = new Database();
    $conn = $database->getConnection();
    
    // Query JOIN dengan tb_jenis untuk mendapatkan field jenis
    $query = "SELECT 
                tb.kode_barang, 
                tb.nama_barang, 
                tb.kode_jenis, 
                tb.stok, 
                tb.harga,
                tj.jenis
              FROM tb_barang tb
              LEFT JOIN tb_jenis tj ON tb.kode_jenis = tj.kode_jenis
              ORDER BY tb.nama_barang ASC";
    
    $result = $conn->query($query);
    
    if (!$result) {
        throw new Exception("Query error: " . $conn->error);
    }
    
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $database->closeConnection();
    echo json_encode($data);
    
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>