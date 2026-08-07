<?php
// ============================================================
// get_submissions.php?type=orders   -> customer bookings
// get_submissions.php?type=contacts -> contact-form enquiries
// Used by admin.html (loadOrdersFromServer / loadContactsFromServer)
// ============================================================
require 'db.php';

$type = $_GET['type'] ?? 'orders';

if ($type === 'orders') {
    $res = $conn->query("SELECT id, order_id, name, phone AS mobile, email,
                                 package_name AS product, amount,
                                 payment_status AS status, payment_method,
                                 message AS notes, source, created_at
                          FROM inquiries
                          WHERE inquiry_type = 'booking'
                          ORDER BY id ASC");
    $rows = [];
    while ($r = $res->fetch_assoc()) {
        $r['amount'] = floatval($r['amount']);
        $rows[] = $r;
    }
    echo json_encode($rows);

} elseif ($type === 'contacts') {
    $res = $conn->query("SELECT id, name, phone, email,
                                 destination AS service, message, created_at
                          FROM inquiries
                          WHERE inquiry_type = 'contact'
                          ORDER BY id ASC");
    $rows = [];
    while ($r = $res->fetch_assoc()) {
        $rows[] = $r;
    }
    echo json_encode($rows);

} else {
    echo json_encode(['status' => 'error', 'message' => 'Unknown type']);
}

$conn->close();