<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php
if (isset($_POST["submit"])) {

    $required_fields = array("username", "password");
    validate_presence($required_fields);

    if (empty($errors)) {
        $username = mysql_prep($_POST["username"]);
        $password = mysql_prep($_POST["password"]);
        $query = "INSERT INTO admins (";
        $query .= "username, hashed_password";
        $query .= ") VALUES (";
        $query .= "'{$username}', '{$password}'";
        $query .= ")";

        $result = mysqli_query($connection, $query);

        if ($result) {
            $_SESSION["message"] = "Admin created.";
            redirect_to("manage_admins.php");
        } else {
            $_SESSION["message"] = "Admin creation failed.";
        }
    }


}

?>

<?php $layout_context = "admin"; ?>
<?php include ("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">

    </div>
    <div id="page">
        <h2>Create Admin</h2>
        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>
        <br />

        <form action="new_admin.php" method="post">
            <p>Username:
                <input type="text" name="username">
            </p>
            <p>Password:
                <input type="password" name="password">
            </p>
            <input type="submit" name="submit" value="Create Admin" />
        </form>
        <br />
        <a href="manage_admins.php">Cancel</a>
    </div>
</div>

