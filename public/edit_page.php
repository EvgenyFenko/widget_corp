<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php find_selected_page() ?>

<!--debug-->
<?php echo '$current_subject = '; var_dump($current_subject); ?>
<br />
<?php echo '$current_page = '; var_dump($current_page); ?>


<?php
if(!$current_page) {


    redirect_to("manage_content.php");
}
?>

<?php
if(isset($_POST['submit'])) {





    $required_fields = array("menu_name", "position", "visible");
    validate_presence($required_fields);

    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if(empty($errors)) {

        $id = $current_subject["id"];
        $menu_name = mysql_prep($_POST["menu_name"]);
        $position = (int)$_POST["position"];
        $visible = (int)$_POST["visible"];

        $query = "UPDATE subjects SET ";
        $query .= " menu_name = '{$menu_name}', ";
        $query .= "position = {$position}, ";
        $query .= "visible = {$visible} ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";

        echo $query;
        echo '<br />';
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) >= 0) {
            $_SESSION["message"] = "Subject updated.";
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
        <?php echo navigation($current_subject, $current_page); ?>
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
                    $subject_count = mysqli_num_rows($subject_set);
                    var_dump($subject_count);
                    for($count = 1; $count <= $subject_count; $count++) {
                        echo "<option value=\"{$count}\"";
                        if($current_subject["position"] == $count) {
                            echo " selected";
                        }
                        echo ">{$count}</option>";
                    }
                    ?>


                </select>
                <?php echo "!!!!!!!!!!".$subject_set ?>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="o" <?php if($current_subject["visible"] == 0) { echo "checked"; }?>/> No
                &nbsp;
                <input type="radio" name="visible" value="1" <?php if($current_subject["visible"] == 1) { echo "checked"; }?>/> Yes
                <!--                <input type="radio" name="visible" value="0"/>-->
            </p>
            <input type="submit" name="submit" value="Edit Subject" />
        </form>
        <br />
        <a href="manage_content.php">Cancel</a>
        &nbsp;
        &nbsp;
        <a href="delete_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>" onclick="return confirm('Are you sure?');"> Delete subject</a>
    </div>
</div>


<?php include("../includes/layouts/footer.php"); ?>

