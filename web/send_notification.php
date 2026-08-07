<?php
// ============================================================
// send_notification.php
// POST (form-data): title, message, type
// ============================================================
require 'db.php';

$title   = trim($_POST['title'] ?? '');
$message = trim($_POST['message'] ?? '');
$type    = trim($_POST['type'] ?? 'general');

if ($title === '' || $message === '') {
    echo json_encode(['status' => 'error', 'message' => 'Title & Message are required']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO notifications (title, message, type) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $title, $message, $type);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'id' => $stmt->insert_id]);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}
$stmt->close();
$conn->close();