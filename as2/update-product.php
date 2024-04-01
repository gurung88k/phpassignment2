<?php
include('shared/auth.php');
$title = 'Saving Product Updates...';
include('shared/header.php');

// Capture form inputs into vars
$productId = $_POST['productId']; // ID value from hidden input on form
$productName = $_POST['product_name'];
$price = $_POST['price'];
$categoryName = $_POST['category'];
$ok = true;

// Input validation before save
if (empty($productName)) {
    echo 'Product Name is required<br />';
    $ok = false;
}

if (empty($price)) {
    echo 'Price is required<br />';
    $ok = false;
} elseif (!is_numeric($price) || $price < 0) {
    echo 'Price must be a non-negative number<br />';
    $ok = false;
}

if (empty($categoryName)) {
    echo 'Category is required<br />';
    $ok = false;
}

// Process photo if any
if ($_FILES['photo']['size'] > 0) {
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;

    // Temporary location in server cache
    $tmp_name = $_FILES['photo']['tmp_name'];

    // File type
    $type = mime_content_type($tmp_name);

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    } else {
        // Save file to img/uploads
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }
} else {
    // No new photo uploaded, keep current photo set in hidden input on form
    // This prevents an existing photo being set to null and removed
    $finalName = $_POST['currentPhoto'] ?? null;
}

if ($ok) {
    try {
        // Connect to db using the PDO (PHP Data Objects Library)
        include('shared/db.php');

        // Set up SQL UPDATE command
        $sql = "UPDATE products 
                SET name = :productName, 
                    price = :price, 
                    category_name = :categoryName, 
                    photo = :photo 
                WHERE product_id = :productId";

        // Link db connection with SQL command we want to run
        $cmd = $db->prepare($sql);

        // Map each input to a column in the products table
        $cmd->bindParam(':name', $productName, PDO::PARAM_STR, 100);
        $cmd->bindParam(':price', $price, PDO::PARAM_INT);
        $cmd->bindParam(':categoryName', $categoryName, PDO::PARAM_STR, 100);
        $cmd->bindParam(':productId', $productId, PDO::PARAM_INT);
        $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

        // Execute the update (which saves to the db)
        $cmd->execute();

        // Disconnect
        $db = null;

        // Show message to user
        echo 'Product Updated';
    } catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
</main>
</body>
</html>
