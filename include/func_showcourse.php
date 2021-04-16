<div style="background: #ffffff; padding:10px;">

    <?php
    echo "<h2>All Course</h2><hr><br>";
    $course_check_query = "SELECT * FROM course";
    $query = mysqli_query($conn, $course_check_query);
    $result = mysqli_fetch_all($query);

    for ($i = 0; $i < sizeof($result); $i++) {
        $coursename = $result[$i][1];
        echo "<a href=" . "../page/detailAdmin.php?name=$coursename" . "><button type=" . "submit" . " name=" . "$coursename" . " class=" . "btn" . ">$coursename</button></a>             ";
        echo "<a href=" . "../DeleteCourse_db.php?delete=$coursename" . "><button type=" . "submit" . " name=" . "DeleteCourse" . " class=" . "btn" . ">DeleteCourse</button></a><br>";
        echo "<br>";
    }

    ?>
    <hr><br>
    <div style="text-align: center">
        <a href="../page/AddCourse.php"><button type="submit" name="AddCourse" class="btn">AddCourse</button></a><br>
    </div>
</div>
<br>