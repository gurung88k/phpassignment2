<?php
$title = 'Show Library';
include('shared/header.php');

try {
    // connect
    include('shared/db.php');

    // set up query to fetch show data
    $sql = "SELECT * FROM shows";
    $cmd = $db->prepare($sql);

    // run query & store results in var called $shows
    $cmd->execute();
    $shows = $cmd->fetchAll();
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>

<main>
    <h1>Show Library</h1>
    <table>
        <thead>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Actions</th>
            <?php if (!empty($_SESSION['username'])): ?>
                <th>Actions</th>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php foreach ($shows as $show): ?>
                <tr>
                    <td><?php echo $show['name']; ?></td>
                    <td>
                        <?php if ($show['photo'] != null): ?>
                            <img src="img/uploads/<?php echo $show['photo']; ?>" class="thumbnail" />
                        <?php endif; ?>
                    </td>
                    <td><?php echo $show['releaseYear']; ?></td>
                    <td><?php echo $show['genre']; ?></td>
                    <td><?php echo $show['service']; ?></td>
                    <?php if (!empty($_SESSION['username'])): ?>
                        <td class="actions">
                            <a href="edit-product.php?showId=<?php echo $show['showId']; ?>">Edit</a>
                            &nbsp;
                            <a href="delete-product.php?showId=<?php echo $show['showId']; ?>" onclick="return confirmDelete();">Delete</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


