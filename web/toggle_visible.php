<?php
// ============================================================
// toggle_visible.php
// POST: id, visible ('yes' | 'no')
// ============================================================
require 'db.php';

$id      = intval($_POST['id'] ?? 0);
$visible = trim($_POST['visible'] ?? '');

if ($id <= 0 || !in_array($visible, ['yes', 'no'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid id or visible value']);
    exit;
}

$stmt = $conn->prepare("UPDATE products SET visible = ? WHERE id = ?");
$stmt->bind_param('si', $visible, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}
$stmt->close();
$conn->close();