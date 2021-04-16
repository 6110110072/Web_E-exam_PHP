<?php
    session_start();
    include('include/server.php');
    $errors = array();
    $VideoStatus = false;
    $FileStatus = false;

    if (isset($_POST['coursename'])) {
        $coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
        if (empty($coursename)) {
            array_push($errors, "coursename is required");
        }

        $course_check_query = "SELECT * FROM course WHERE coursename = '$coursename' LIMIT 1";
        $query = mysqli_query($conn, $course_check_query);
        $result = mysqli_fetch_assoc($query);
        if ($result['coursename'] === $coursename) {
            array_push($errors, "This Course already exists<br>");
        }
    }

    if (isset($_POST['description'])) {
        $description = mysqli_real_escape_string($conn, $_POST['description']);
    }
    if (isset($_POST['youtubelink'])) {
        $youtubelink = mysqli_real_escape_string($conn, $_POST['youtubelink']);
    }

    if ($_FILES['my_file']['name'] != "") {
        $target_dir = "files/";
        $file = $_FILES['my_file']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $size = $_FILES['my_file']['size'];
        $type = $_FILES['my_file']['type'];
        $temp_name = $_FILES['my_file']['tmp_name'];
        $path_filename_ext = $target_dir . $filename . "." . $ext;


        // Check if file already exists
        if ($size > 2097152) {
            array_push($errors, "Sorry, file size if over then 2MB.<br>");
        } else if (file_exists($path_filename_ext)) {
            array_push($errors, "Sorry, file already exists.<br>");
        } else if (strcmp($type, "application/pdf") == 0) {
            $FileStatus = true;
        } else {
            array_push($errors, "Sorry, Please Upload PDF Files.<br>");
        }
    }

    if ($_FILES['my_video']['name'] != "") {
        $target_dir = "files/";
        $video = $_FILES['my_video']['name'];
        $path = pathinfo($video);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $size = $_FILES['my_video']['size'];
        $type = $_FILES['my_video']['type'];
        $temp_video = $_FILES['my_video']['tmp_name'];
        $path_videoname_ext = $target_dir . $filename . "." . $ext;

        if ($size > 2097152) {
            array_push($errors, "Sorry, video size if over then 2MB.<br>");
        } else if (file_exists($path_videoname_ext)) {
            // Check if video already exists
            array_push($errors, "Sorry, video already exists.<br>");
        } else if (strcmp($type, "video/mp4") == 0) {
            $VideoStatus = true;
        } else {
            array_push($errors, "Sorry, Please Upload .mp4 Files.<br>");
        }
    }


    if (count($errors) == 0) {
        $sql = "INSERT INTO course (coursename,description,filename,videoname,youtubelink) VALUES ('$coursename','$description','$file','$video','$youtubelink')";
        mysqli_query($conn, $sql);
        $scorecourse = "ALTER TABLE user ADD $coursename varchar(100);";
        mysqli_query($conn, $scorecourse);
        $setDefault = "UPDATE user SET $coursename='0'";
        mysqli_query($conn, $setDefault);


        if ($VideoStatus && $FileStatus) {
            move_uploaded_file($temp_name, $path_filename_ext);
            move_uploaded_file($temp_video, $path_videoname_ext);
        }

        $_SESSION['coursename'] = $coursename;
        $_SESSION['success'] = "Add Course and upload successfully.";
    } else {
        for ($i = 0; $i < sizeof($errors); $i++) {
            $_SESSION['error'] .= $errors[$i];
        }
    }

    header('location: page/admin.php');
?>
