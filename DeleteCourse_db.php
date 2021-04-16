<?php
session_start();
include('include/server.php');

//detele in DB
if (isset($_GET['delete'])) {
    $coursename = $_GET['delete'];
    // delete file form directory
    $course_check_query = "SELECT * FROM course WHERE coursename = '$coursename'";
    $query = mysqli_query($conn, $course_check_query);
    $result = mysqli_fetch_all($query);
    $deletefile = "files/".$result[0][5];//column file
    $deletevideo = "files/".$result[0][6];//cloumn video
    $fileList = glob('files/*');
        foreach ($fileList as $filename){
            if(strcmp($filename,$deletefile)==0 || strcmp($filename,$deletevideo)==0){
                unlink($filename);
            }
        }

    $delete = "DELETE FROM course WHERE coursename = '$coursename'";
    mysqli_query($conn, $delete);

    $delete = "DELETE FROM exam WHERE coursename = '$coursename'";
    mysqli_query($conn, $delete);

    $deletecourseUser = "ALTER TABLE user DROP COLUMN $coursename;";
    mysqli_query($conn, $deletecourseUser);


    $_SESSION['success'] = "Delete Course Successfully";
    header('location:page/admin.php');
}
?>
