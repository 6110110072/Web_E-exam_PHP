<?php
session_start();
include('../include/server.php');
if (isset($_GET['name'])) {
    $coursename = $_GET['name'];
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
        <a href="../page/admin.php">Back</a><br><br>

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
            File name  : <a href="<?php echo "../files/" . $file; ?>"><?php echo $file; ?></a> <br>
            Video name : <a href="<?php echo "../files/" . $video; ?>"><?php echo $video; ?></a> <br>
            <div style="text-align: center">
                <video width="400" controls style>
                    <source src="<?php echo "../files/" . $video; ?>" type="video/mp4">
                    Your browser does not support HTML video.
                </video>

            </div>
            <br>
            Youtube link : <a href="<?php echo $youtubelink; ?>"><?php echo $youtubelink; ?></a>
            <br><br>
        </div>
        <!-- question -->
        <?php
        $sql_question = "SELECT * FROM exam WHERE coursename='$coursename'";
        $query = mysqli_query($conn, $sql_question);
        $result = mysqli_fetch_all($query);
        echo "<h2>All Question<br><br></h2>";
        for ($i = 0; $i < sizeof($result); $i++) {
            $questionname = $result[$i][1];
            echo "Question : " . $questionname;
            if (strpos($questionname, "+")) {
                $questionname = str_replace("+", "%2B", $questionname);
            }
            echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=" . "../Deletequestion_db.php?questionname=$questionname&coursename=$coursename" . "><button type=" . "submit" . " name=" . "questionname" . " class=" . "btn" . ">Delete</button></a><br>";
            echo "<br>";
        }
        ?>

        <div style="text-align: center">
            <a href="Addexam.php?name=<?php echo $coursename ?>"><button type="submit" name="Addexam" class="btn">Add exam</button></a><br>
        </div>
    </div>
</body>

</html>