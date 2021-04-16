<?php
    session_start();
    include('include/server.php');
    if (isset($_GET['questionname'])) {
        $coursename = mysqli_real_escape_string($conn, $_GET['coursename']);
    }


    if (isset($_GET['questionname'])) {
        $questionname = $_GET['questionname'];
        var_dump($_GET['questionname']);
        $delete = "DELETE FROM exam WHERE question = '$questionname'";
        mysqli_query($conn, $delete);
        $_SESSION['success'] = "Delete Exam Successfully";
        header('location:page/detailAdmin.php?name='.$coursename);

    }
