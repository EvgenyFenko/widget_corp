<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php
if (isset($_POST["submit"])) {

    $required_fields = array("username", "password");
    validate_presence($required_fields);

    if (empty($errors)) {

    $found_admin = attempt_login($username, $password);

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
        &nbsp;&nbsp;
    </div>
    <div id="page">

        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>

        <h2>Login</h2>
        <form action="login.php" method="post">
            <p>Username:
                <input type="text" name="username" value="">
            </p>
            <p>Password:
                <input type="password" name="password" value="">
            </p>
            <input type="submit" name="submit" value="Submit" />
        </form>
    </div>
</div>

