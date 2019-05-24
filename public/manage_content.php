<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php

    $query = "SELECT *";
    $query .= "FROM subjects ";
    $query .= "WHERE visible = 1 ";
    $query .= "ORDER by position ASC";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">
        <ul class="subjects">
            <?php

                while ($subject = mysqli_fetch_assoc($result)){

            ?>
            <li><?php echo $subject["menu_name"] . "(" . $subject["id"] . ")"; ?></li>
            <?php
                }
            ?>
        </ul>
    </div>
    <div id="page">
        <h2>Manage Content</h2>

    </div>
</div>
<?php

mysqli_free_result($result);
?>

<?php include("../includes/layouts/footer.php"); ?>

