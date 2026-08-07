<?php
// ============================================================
// update_order_status.php
// POST: id, status ('Paid' | 'Not Paid')
// Used by admin.html updateStatus()
// ============================================================
require 'db.php';

$id     = intval($_POST['id'] ?? 0);
$status = trim($_POST['status'] ?? '');

if ($id <= 0 || !in_array($status, ['Paid', 'Not Paid'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid id or status']);
    exit;
}

$stmt = $conn->prepare("UPDATE inquiries SET payment_status = ? WHERE id = ? AND inquiry_type = 'booking'");
$stmt->bind_param('si', $status, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}
$stmt->close();
$conn->close();