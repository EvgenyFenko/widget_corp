<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    $admins_set = find_all_admins();
?>

<?php $layout_context = "admin"; ?>
<?php include ("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">
        &nbsp;
    </div>
    <div id="page">
        <?php echo message(); ?>
        <h2>Manage Admins</h2>
        <br />
        <table>
            <tr>
                <th style="text-align: left; width: 200px;">Username</th>
                <th colspan="2" style="text-align: left;">Actions</th>
            </tr>
            <?php
                while ($admin = mysqli_fetch_assoc($admins_set)){
                    $output = "<tr>";
                    $output .= "<td>";
                    $output .= $admin["username"];
                    $output .= "</td>";
                    $output .= "<td>";
                    $output .= "<a href = edit_admin.php?id=".$admin["id"].">Edit </a>";
                    $output .= "<a href = delete_admin.php?id=".$admin["id"]." onclick=\"return confirm('Are you sure?');\"> Delete</a>";
                    $output .= "</td>";
                    $output .= "</tr>";
                    echo $output;
                }
            ?>
        </table>
        <br />
        <a href="new_admin.php">Add new admin</a>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>