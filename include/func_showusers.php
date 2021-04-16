<?php
echo "<h2>All User</h2><hr><br>";
$user_check_query = "SELECT * FROM user";
$query = mysqli_query($conn, $user_check_query);
$result = mysqli_fetch_all($query);

$course_check_query = "SELECT * FROM course";
$querycourse = mysqli_query($conn, $course_check_query);
$resultcourse = mysqli_fetch_all($querycourse);

for ($i = 1; $i < sizeof($result); $i++) {
    $id = $result[$i][0];
    $username = $result[$i][1];
    echo "<h3>ID: " . $id . "&nbsp;&nbsp;&nbsp;&nbsp;username: " . $username . "</h3>";
    for ($j = 0; $j < sizeof($resultcourse); $j++) {
        $coursename = $resultcourse[$j][1];
        $exam_check_query = "SELECT * FROM exam WHERE coursename='$coursename'";
        $queryexam = mysqli_query($conn, $exam_check_query);
        $resultexam = mysqli_fetch_all($queryexam);
        $num_ques = sizeof($resultexam);
        echo "<h4><li>";
        echo "Course: " . $coursename . " get score " . $result[$i][($j + 4)] . "/".$num_ques;
        echo "</li></h4>";
    }
    echo "<br>";
}
?>