<?php 
$title = 'Add Product';
include('shared/header.php');
?>

<h2>Add a New Product</h2>
<form method="post" action="insert-product.php" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Name: *</label>
        <input name="name" id="name" required />
    </fieldset>
    <fieldset>
        <label for="price">Price: *</label>
        <input name="price" id="price" required type="number" min="0" step="0.01" />
    </fieldset>
    <fieldset>
        <label for="category">Category: *</label>
        <select name="category" id="category" required>
            <?php
            try {
                // connect to the database
                include('shared/db.php');

                // set up & run query to fetch categories
                $sql = "SELECT * FROM categories ORDER BY name";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $categories = $cmd->fetchAll();

                // loop through categories and add each one to the dropdown
                foreach ($categories as $category) {
                    echo '<option>' . $category['name'] . '</option>';
                }

                // disconnect from the database
                $db = null;
            } catch (Exception $err) {
                // handle errors
                header('location:error.php');
                exit();
            }
            ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" />
    </fieldset>
    <button class="offset-button">Submit</button>
</form>

<?php include('shared/footer.php'); ?>
