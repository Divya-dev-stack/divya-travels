<?php
// ============================================================
// clear_data.php
// POST: target = all_demo_data | orders_all | contacts_boutique | notifications_all
// Used by admin.html clearData()
// ============================================================
require 'db.php';

$target = trim($_POST['target'] ?? '');

switch ($target) {
    case 'all_demo_data':
        // deletes ALL bookings + contact enquiries (products untouched)
        $conn->query("DELETE FROM inquiries");
        echo json_encode(['status' => 'success']);
        break;

    case 'orders_all':
        $conn->query("DELETE FROM inquiries WHERE inquiry_type = 'booking'");
        echo json_encode(['status' => 'success']);
        break;

    case 'contacts_boutique':
        $conn->query("DELETE FROM inquiries WHERE inquiry_type = 'contact'");
        echo json_encode(['status' => 'success']);
        break;

    case 'notifications_all':
        $conn->query("DELETE FROM notifications");
        echo json_encode(['status' => 'success']);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Unknown target']);
}

$conn->close();