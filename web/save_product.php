<?php
// ============================================================
// save_product.php
// POST (multipart form-data), used by BOTH:
//   - uploadProduct()      -> no 'id' field  => INSERT
//   - saveEditPackage()    -> has 'id' field => UPDATE
// Fields: name, cat, price, description, stock, visible,
//         highlights (JSON string), price_tags (JSON string), photo (base64, optional)
// ============================================================
require 'db.php';

$id          = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name        = trim($_POST['name'] ?? '');
$cat         = trim($_POST['cat'] ?? '');
$price       = floatval($_POST['price'] ?? 0);
$description = trim($_POST['description'] ?? '');
$stock       = trim($_POST['stock'] ?? 'Available');
$visible     = trim($_POST['visible'] ?? 'yes');
$highlights  = trim($_POST['highlights'] ?? '[]');
$priceTags   = trim($_POST['price_tags'] ?? '[]');
$photo       = isset($_POST['photo']) ? $_POST['photo'] : null; // base64 string or null

if ($name === '' || $price <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Name & Price are required']);
    exit;
}

// validate JSON, fall back to empty array if malformed
json_decode($highlights);
if (json_last_error() !== JSON_ERROR_NONE) $highlights = '[]';
json_decode($priceTags);
if (json_last_error() !== JSON_ERROR_NONE) $priceTags = '[]';

if ($id > 0) {
    // ---------- UPDATE ----------
    if ($photo) {
        $stmt = $conn->prepare("UPDATE products SET
            name=?, category=?, price=?, description=?, stock=?, visible=?,
            highlights=?, price_tags=?, photo=?
            WHERE id=?");
        $stmt->bind_param('ssdssssssi', $name, $cat, $price, $description, $stock, $visible, $highlights, $priceTags, $photo, $id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET
            name=?, category=?, price=?, description=?, stock=?, visible=?,
            highlights=?, price_tags=?
            WHERE id=?");
        $stmt->bind_param('ssdssssi', $name, $cat, $price, $description, $stock, $visible, $highlights, $priceTags, $id);
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'id' => $id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();

} else {
    // ---------- INSERT ----------
    $stmt = $conn->prepare("INSERT INTO products
        (name, category, price, description, stock, visible, highlights, price_tags, photo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssdssssss', $name, $cat, $price, $description, $stock, $visible, $highlights, $priceTags, $photo);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'id' => $stmt->insert_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
    $stmt->close();
}

$conn->close();