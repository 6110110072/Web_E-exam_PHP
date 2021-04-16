<?php
session_start();
include('../include/server.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new Course</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="header">
        <h2>Add new Course</h2>
    </div>
    <form action="../AddCourse_db.php" method="post"  enctype="multipart/form-data">
        <div class="input-group">
            <label for="coursename">Course Name </label>
            <input type="text" name="coursename" required>
            <br><br>
            <label for="description">Description</label>
            <input type="text" name="description">
            <br><br>
            <label for="youtubelink">Youtube Link</label>
            <input type="url" name="youtubelink">
            <br><br>
            <label for="my_file">Add new Files</label>
            <input type="file" name="my_file" /><br /><br />
            <label for="my_video">Add new Video</label>
            <input type="file" name="my_video" /><br /><br />
            <label style="color:red;">file size maximum 2MB and can upload only .mp4 or PDF Files!</label><br>
        </div>
        <br>
        <div class="input-group" style="text-align: center">
            <button type="submit" name="addcourse" class="btn">AddCourse</button>
        </div>
    </form>

</body>

</html>