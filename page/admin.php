<?php
session_start();
$CourseList = array();
include('../include/server.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You Must Login First";
    header('location: admin.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        #outer {
            width: 100%;
            text-align: center;
        }

        .inner {
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Admin Page</h2>
    </div>
    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);

                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['UploadSuccess'])) : ?>
            <div class="success">
                <h3>
                    <?php
                    echo $_SESSION['UploadSuccess'];
                    unset($_SESSION['UploadSuccess']);

                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['UploadFail'])) : ?>
            <div class="error">
                <h3>
                    <?php
                    echo $_SESSION['UploadFail'];
                    unset($_SESSION['UploadFail']);

                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);

                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <div style="text-align: right">
            <p><a href="admin.php?logout='1'" style="color :red;">Logout</a></p>
            </div>
            <div style="text-align: center">
            <h2><p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p></h2>
            </div><br>

        <?php endif ?>

        <!-- show user -->
        <?php include('../include/func_showusers.php'); ?>

        <!-- แสดง course -->
        <?php include('../include/func_showcourse.php'); ?>




    </div>


</body>

</html>