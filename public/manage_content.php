<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "widget_corp";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(mysqli_connect_errno()){
        die("Database connection failed: ".mysqli_connect_error()." (".mysqli_connect_errno().")"
        );
    }
?>

<?php require_once("../includes/functions.php"); ?>

<?php

    $query = "SELECT *";
    $query .= "FROM subjects ";
    $query .= "WHERE visible = 1 ";
    $query .= "ORDER by position ASC";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Database query failed.");
    }
?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">
        <ul>
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
<?php

    mysqli_close($connection);
?>
