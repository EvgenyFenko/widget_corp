<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include ("../includes/layouts/header.php"); ?>
<?php find_selected_page() ?>

<div id="main">
    <div id="navigation">
        <?php echo navigation($current_subject, $current_page); ?>
    </div>
    <div id="page">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors); ?>

        <h2>Create Page</h2>

        <form action="create_page.php" method="post">

            <p>Subject id:
                <select name="subject_id">
                    <?php
                        $subject_set = find_subjects();
                        while ($row = mysqli_fetch_assoc($subject_set)){
                            echo "<option value=\"{$row["id"]}\">{$row["id"]}</option>";
                        }
                    ?>
                </select>
            </p>
            <p>Menu name:
                <input type="text" name="menu_name" value="" />
            </p>
            <p>Position:
                <select name="position">
                    <?php
                        $page_set = find_all_positions_of_pages();
                        $page_count = mysqli_fetch_assoc($page_set);
                        $page_count = $page_count["COUNT(DISTINCT position)"];
                        for($count = 1; $count <= ($page_count + 1); $count++) {
                            echo "<option value=\"{$count}\">{$count}</option>";
                        }
                    ?>


                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="o" /> No
                &nbsp;
                <input type="radio" name="visible" value="1" /> Yes
            </p>
            <p>Content:
                <input type="text" name="content" value="">
            </p>
            <input type="submit" name="submit" value="Create Page" />
        </form>
        <br />
        <a href="manage_content.php">Cancel</a>
    </div>
</div>


<?php include("../includes/layouts/footer.php"); ?>

