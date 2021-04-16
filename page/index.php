<?php
session_start();
include('../include/server.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You Must Login First";
    header('location: index.php');
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
    <title>Home Page</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="header">
        <h2>Home Page</h2>
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

        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <div style="text-align: right">
            <p><a href="index.php?logout='1'" style="color :red;">Logout</a></p>
            </div>
            <div style="text-align: center">
            <h2><p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p></h2>
            </div><br>
        <?php endif ?>


        <div style="background: #ffffff; padding:10px;">

            <?php
            $username = $_SESSION['username'];
            $course_check_query = "SELECT * FROM course";
            $query = mysqli_query($conn, $course_check_query);
            $result = mysqli_fetch_all($query);
            echo "<h2>All Course</h2><hr><br>";
            for ($i = 0; $i < sizeof($result); $i++) {
                $coursename = $result[$i][1];
                echo "<a href=" . "../page/detailUser.php?coursename=$coursename&username=$username" . "><button type=" . "submit" . " name=" . "$coursename" . " class=" . "btn" . ">$coursename</button></a>         ";
            }
            ?>
        </div>
    </div>
</body>
</html>