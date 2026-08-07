<?php
// ============================================================
// get_notifications.php
// Used by admin.html renderNotifications() and could also be
// polled by website.html to show the bell-icon notification list.
// ============================================================
require 'db.php';

$res = $conn->query("SELECT id, title, message, type, created_at FROM notifications ORDER BY id ASC");
$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = $r;
}
echo json_encode($rows);
$conn->close();