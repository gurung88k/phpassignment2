
<?php 
// auth check
include('shared/auth.php');

$title = 'Add Service';
include('shared/header.php'); ?>

<h2>Add a new category:</h2>
<form method="post" action="insert-category.php">
    <fieldset>
        <label for="name">Name: *</label>
        <input name="name" id="name" required />
    <button>Submit</button>
</form>
</main>
</body>
</html>
