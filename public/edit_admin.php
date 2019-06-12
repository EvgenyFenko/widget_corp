<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
    $admin = find_admin_by_id($_GET["id"]);
    if (!$admin) {
        redirect_to("manage_admins.php");
    }
?>

<?php

    if(isset($_POST['submit'])) {
        $required_fields = array("username", "hashed_password");
        validate_presence($required_fields);

        if(empty($errors)) {
            $id = $admin["id"];
            $username = mysql_prep($_POST["username"]);
            $password = password_encrypt($_POST["hashed_password"]);

            $query = "UPDATE admins SET ";
            $query .= "username = '{$username}', ";
            $query .= "hashed_password = '{$password}' ";
            $query .= "WHERE id = {$id} ";
            $query .= "LIMIT 1";

            $result = mysqli_query($connection, $query);

            if ($result && mysqli_affected_rows($connection) == 1) {
                $_SESSION["message"] = "Admin updated.";
                redirect_to("manage_admins.php");
            } else {
                $message = "Admin update failed";
            }
        }
    } else {
?>
        <?php $layout_context = "admin"; ?>
        <?php include ("../includes/layouts/header.php"); ?>
        <div id="main">
            <div id="navigation">
                &nbsp;
            </div>
            <div id="page">
                <?php echo message(); ?>
                <?php echo form_errors($errors); ?>

                <h2>Edit Admin <?php echo htmlentities($admin['username']) ?></h2>
                <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
                    <p>Username:
                        <input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" />
                    </p>
                    <p>Password:
                        <input type="password" name="hashed_password" value="<?php echo htmlentities($admin["hashed_password"]); ?>" />
                    </p>
                    <input type="submit" name="submit" value="Edit Admin" />
                </form>
                <br />
                <a href="manage_admins.php">Cancel</a>
            </div>
        </div>
        <?php include ("../includes/layouts/footer.php") ?>
<?php
    }
?>
