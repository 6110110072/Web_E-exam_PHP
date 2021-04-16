<?php
session_start();
include('../include/server.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You Must Login First";
    header('location: index.php');
}

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
    <title>Pretest Examination <?php echo $coursename ?></title>
    <link rel="stylesheet" href="../style.css">
    <style>
        form {
            width: 100%;
            margin: 0 auto;
            border: 0px;
            padding: 0px;
            background: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pretest Examination <?php echo $coursename ?></h1>
    </div>
    <div class="content">
        <a href="detailUser.php?coursename=<?php echo $coursename . "&" . "username=" . $username ?>">Back</a><br><br>
        <?php if (isset($_SESSION['score'])) : ?>
            <div class="success">
                <h3>
                    <?php
                    echo $_SESSION['score'];
                    unset($_SESSION['score']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <h2>Multiple Choice Questions Answers</h2><br>
        <form action="../scoreexam.php?coursename=<?php echo $coursename . "&" . "username=" . $username ?>" method="post">

            <?php
            $sql_exam = "SELECT * FROM exam WHERE coursename='$coursename'";
            $query = mysqli_query($conn, $sql_exam);
            $result = mysqli_fetch_all($query);

            for ($i = 0; $i < sizeof($result); $i++) {
                echo "<h3>Ques" . ($i + 1) . " : " . $result[$i][1] . "</h3>";
                echo "<div class=" . "form-group" . ">";
                echo "<ol>";
                echo "<li>";
                echo "<input type=" . "radio" . " name=" . "q" . ($i + 1) . " value=" . "1" . " required/>" . $result[$i][2];
                echo "</li>";
                echo "<li>";
                echo "<input type=" . "radio" . " name=" . "q" . ($i + 1) . " value=" . "2" . " required/>" . $result[$i][3];
                echo "</li>";
                echo "<li>";
                echo "<input type=" . "radio" . " name=" . "q" . ($i + 1) . " value=" . "3" . " required/>" . $result[$i][4];
                echo "</li>";
                echo "<li>";
                echo "<input type=" . "radio" . " name=" . "q" . ($i + 1) . " value=" . "4" . " required/>" . $result[$i][5];
                echo "</li>";
                echo "</ol>";
                echo "</div><br>";
            }

            ?>
            <br>
            <div style="text-align: center">
                <div class=" form-group">
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
</body>
</body>

</html>