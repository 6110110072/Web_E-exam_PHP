<?php
session_start();
include('../include/server.php');
if (isset($_GET['coursename'])) {
    $coursename = $_GET['coursename'];
}
if (isset($_GET['username'])) {
    $username = $_GET['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details <?php echo $coursename ?> Course</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="header">
        <h1>Details <?php echo $coursename ?> Course</h1>
    </div>

    <div class="content">
        <a href="../page/index.php">Back</a><br><br>

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

        <!-- show files, video, description, link youtube-->
        <?php
        $basepath = "../files/";
        $course_check_query = "SELECT * FROM course WHERE coursename = '$coursename'";
        $query = mysqli_query($conn, $course_check_query);
        $result = mysqli_fetch_all($query);
        echo "<h2>All Description</h2><br>";
        $description = $result[0][4]; //column description
        $file = $result[0][5]; //column file
        $video = $result[0][6]; //cloumn video
        $youtubelink = $result[0][7]; //cloumn youtubelink
        ?>
        <div>
            <h3><?php echo $description; ?> </h3>
            File name  : <a href="<?php echo $basepath . $file; ?>"><?php echo $file; ?></a> <br>
            Video name : <a href="<?php echo $basepath . $video; ?>"><?php echo $video; ?></a> <br>
            <div style="text-align: center">
                <video width="400" controls style>
                    <source src="<?php echo $basepath . $video; ?>" type="video/mp4">
                    Your browser does not support HTML video.
                </video>

            </div>
            <br>
            Youtube link : <a href="<?php echo $youtubelink; ?>"><?php echo $youtubelink; ?></a>
            <br><br>
        </div>

        <div style="text-align: center">
        <a href="PreTestexam.php?coursename=<?php echo $coursename."&"."username=".$username?>"><button type="submit" name="PreTestexam" class="btn">PreTest exam</button></a><br>
        </div>

    </div>
</body>
</html>