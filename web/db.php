<?php
// ============================================================
// db.php - shared DB connection. Every other PHP file includes this.
// UPDATE these 4 values to match your hosting / XAMPP / cPanel DB.
// ============================================================
$DB_HOST = 'localhost';
$DB_NAME = 'divya_travels';
$DB_USER = 'root';
$DB_PASS = '';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}
$conn->set_charset('utf8mb4');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// small helper to generate the next booking reference, e.g. DT0001
function next_order_id($conn) {
    $res = $conn->query("SELECT COUNT(*) AS c FROM inquiries WHERE inquiry_type='booking'");
    $row = $res->fetch_assoc();
    $n = intval($row['c']) + 1;
    return 'DT' . str_pad($n, 4, '0', STR_PAD_LEFT);
}