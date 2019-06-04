<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include ("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">

    </div>
    <div id="page">
        <h2>Manage Admins</h2>
        <br />
        <table>
            <tr>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
                $result = find_all_admins();
                while ($admins_set = mysqli_fetch_assoc($result)){
                    $output = "<tr>";
                    $output .= "<td>";
                    $output .= $admins_set["username"];
                    $output .= "</td>";
                    $output .= "<td>";
                    $output .= "<a href = edit_admin.php?id=".$admins_set["id"].">Edit </a>";
                    $output .= "<a href = delete_admin.php?id=".$admins_set["id"]."> Delete</a>";
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