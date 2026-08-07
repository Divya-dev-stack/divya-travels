<?php
// ============================================================
// submit_forms.php
// Called from the CUSTOMER website (website.html -> submitBuyOrder()).
// Accepts JSON body: { type:'order'|'contact', name, mobile, product,
//                       amount, notes, source, email, service, message }
// ============================================================
require 'db.php';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request body']);
    exit;
}

$type = isset($data['type']) ? $data['type'] : 'order';

if ($type === 'order') {
    $name    = trim($data['name'] ?? '');
    $mobile  = trim($data['mobile'] ?? '');
    $email   = trim($data['email'] ?? '');
    $product = trim($data['product'] ?? '');
    $amount  = floatval($data['amount'] ?? 0);
    $notes   = trim($data['notes'] ?? '');
    $source  = trim($data['source'] ?? 'website');

    if ($name === '' || $mobile === '') {
        echo json_encode(['status' => 'error', 'message' => 'Name & Mobile are required']);
        exit;
    }

    $order_id = next_order_id($conn);

    $stmt = $conn->prepare("INSERT INTO inquiries
        (order_id, name, phone, email, inquiry_type, package_name, message, amount, payment_status, source)
        VALUES (?, ?, ?, ?, 'booking', ?, ?, ?, 'Not Paid', ?)");
    $stmt->bind_param('sssssdss', $order_id, $name, $mobile, $email, $product, $notes, $amount, $source);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'order_id' => $order_id, 'id' => $stmt->insert_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();

} elseif ($type === 'contact') {
    $name    = trim($data['name'] ?? '');
    $phone   = trim($data['mobile'] ?? $data['phone'] ?? '');
    $email   = trim($data['email'] ?? '');
    $service = trim($data['service'] ?? 'General Enquiry');
    $message = trim($data['message'] ?? '');

    if ($name === '' || $phone === '') {
        echo json_encode(['status' => 'error', 'message' => 'Name & Phone are required']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO inquiries
        (name, phone, email, inquiry_type, destination, message, source)
        VALUES (?, ?, ?, 'contact', ?, ?, 'website')");
    $stmt->bind_param('sssss', $name, $phone, $email, $service, $message);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'id' => $stmt->insert_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();

} else {
    echo json_encode(['status' => 'error', 'message' => 'Unknown type']);
}

$conn->close();