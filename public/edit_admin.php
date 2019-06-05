<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php

    if(isset($_POST['submit'])) {
?>


<?php
    } else {
?>
        <?php $layout_context = "admin"; ?>
        <?php include ("../includes/layouts/header.php"); ?>
        <div id="main">
            <div id="navigation">
            </div>
            <div id="page">
                <?php
                if(!empty($message)) {
                    echo "<div class=\"message\">" . htmlentities($message) . "</div>";
                }
                ?>
                <?php echo form_errors($errors); ?>
                <?php $current_admin = find_admin_by_id($_GET['id']) ?>
                <h2>Edit Admin <?php echo htmlentities($current_admin['username']) ?></h2>
                <form action="edit_admin.php?admin=<?php echo urlencode($current_admin["id"]); ?>" method="post">
                    <p>Username:
                        <input type="text" name="username" value="<?php echo htmlentities($current_admin["username"]); ?>" />
                    </p>
                    <p>Password:
                        <input type="password" name="hashed_password" value="<?php echo htmlentities($current_admin["hashed_password"]); ?>" />
                    </p>
                    <input type="submit" name="submit" value="Edit Admin" />
                </form>
                <br />
                <a href="manage_admins.php">Cancel</a>
            </div>
        </div>

<?php
    }
?>
