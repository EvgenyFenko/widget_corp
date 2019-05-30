<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php find_selected_page() ?>

<?php
if(!$current_page) {


    redirect_to("manage_content.php");
}
?>

<?php
    if(isset($_POST['submit'])) {



        $required_fields = array("menu_name", "position", "visible", "content");
        validate_presence($required_fields);

        $fields_with_max_lengths = array("menu_name" => 30);
        validate_max_lengths($fields_with_max_lengths);

        if(empty($errors)) {

            $id = $current_page["id"];
            $menu_name = mysql_prep($_POST["menu_name"]);
            $position = (int)$_POST["position"];
            $visible = (int)$_POST["visible"];

            $query = "UPDATE pages SET ";
            $query .= " menu_name = '{$menu_name}', ";
            $query .= "position = {$position}, ";
            $query .= "visible = {$visible} ";
            $query .= "WHERE id = {$id} ";
            $query .= "LIMIT 1";

            echo $query;
            echo '<br />';
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_affected_rows($connection) >= 0) {
                $_SESSION["message"] = "Page updated.";
                redirect_to("manage_content.php");

            } else {
                $message = "Subject update failed";

            }
        }
    }else {
}
?>

<?php include ("../includes/layouts/header.php"); ?>


<div id="main">
    <div id="navigation">
<?php //echo navigation($current_subject, $current_page); ?>
    </div>
    <div id="page">
        <?php
        if(!empty($message)) {
            echo "<div class=\"message\">" . htmlentities($message) . "</div>";
        }
        ?>
        <?php echo form_errors($errors); ?>
        <h2>Edit Page <?php echo htmlentities($current_page["menu_name"]); ?></h2>

        <form action="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
            <p>Page name:
                <input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]); ?>" />
            </p>
            <p>Position:
                <select name="position">
                    <?php
                    $pages_set = find_all_pages_of_current_subject($current_page["subject_id"]);
                    $pages_count = mysqli_num_rows($pages_set);
                    for($count = 1; $count <= $pages_count; $count++) {
                        echo "<option value=\"{$count}\"";
                        if($current_page["position"] == $count) {
                            echo " selected";
                        }
                        echo ">{$count}</option>";
                    }
                    ?>


                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="o" <?php if($current_page["visible"] == 0) { echo "checked"; }?>/> No
                &nbsp;
                <input type="radio" name="visible" value="1" <?php if($current_page["visible"] == 1) { echo "checked"; }?>/> Yes
            </p>
            <p>
                <input type="text" name="content" value="<?php echo htmlentities($current_page["content"]); ?>" />
            </p>
            <input type="submit" name="submit" value="Edit Page" />
        </form>
        <br />
        <a href="manage_content.php">Cancel</a>
        &nbsp;
        &nbsp;
        <a href="delete_page.php?page=<?php echo urlencode($current_page["id"]); ?>" onclick="return confirm('Are you sure?');"> Delete page</a>
    </div>
</div>


<?php include("../includes/layouts/footer.php"); ?>

