<?php 
include('shared/auth.php');
$title = 'Edit Product';
include('shared/header.php'); 

// Get the productId from the URL parameter using $_GET
$productId = $_GET['productId'];

// Initialize variables
$name = null;
$price = null;
$category = null;

// If productId is numeric, fetch product from the database
if (is_numeric($productId)) {
    try {
        // Connect to the database
        include('shared/db.php');

        // Run query & populate product properties for display
        $sql = "SELECT * FROM products WHERE product_id = :productId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':productId', $productId, PDO::PARAM_INT);
        $cmd->execute();
        $product = $cmd->fetch();  

        $name = $product['name'];
        $price = $product['price'];
        $category = $product['category_name'];
    }
    catch (Exception $err) {
        // Redirect to error page if there's an error
        header('location:error.php');
        exit();
    }
}

?>

<h2>Edit Product Details</h2>
<form method="post" action="update-product.php" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Name: *</label>
        <input name="product_name" id="name" required value="<?php echo $name; ?>" />
    </fieldset>
    <fieldset>
        <label for="price">Price: *</label>
        <input name="price" id="price" required type="number" step="0.01" value="<?php echo $price; ?>" />
    </fieldset>
    <fieldset>
        <label for="category">Category: *</label>
        <input name="category" id="category" required value="<?php echo $category; ?>" />
    </fieldset>
    <input type="hidden" name="productId" id="productId" value="<?php echo $productId; ?>" />
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>
