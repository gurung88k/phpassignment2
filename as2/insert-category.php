<?php
include('shared/auth.php');

$title = 'Saving New Category';
include('shared/header.php');

// Capture form input
$name = $_POST['name'];
$ok = true;

// Validation
if (empty($name)) {
    $ok = false;
    echo 'Name is required';
}

if ($ok == true) {
    try {
        // Connect to the database
        include('shared/db.php');

        // Set up SQL INSERT
        $sql = "INSERT INTO categories (categoryname) VALUES (:categoryname)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':categoryname', $name, PDO::PARAM_STR, 100);
        $cmd->execute();

        $db = null;
        echo 'Category Saved';
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
</main>
</body>
</html>
