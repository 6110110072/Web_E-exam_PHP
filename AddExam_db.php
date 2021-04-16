<?php
    session_start();
    include('include/server.php');
    if (isset($_GET['name'])) {
        $coursename = $_GET['name'];
    }
    if (isset($_POST['AddExam'])) {
        $question = mysqli_real_escape_string($conn, $_POST['Question']);
        $choice1 = mysqli_real_escape_string($conn, $_POST['Choice1']);
        $choice2 = mysqli_real_escape_string($conn, $_POST['Choice2']);
        $choice3 = mysqli_real_escape_string($conn, $_POST['Choice3']);
        $choice4 = mysqli_real_escape_string($conn, $_POST['Choice4']);
        $ans = mysqli_real_escape_string($conn, $_POST['ans']);
        $sql = "INSERT INTO exam (coursename,question,choice1,choice2,choice3,choice4,answer) VALUES ('$coursename','$question','$choice1','$choice2','$choice3','$choice4','$ans')";
        mysqli_query($conn, $sql);
        $_SESSION['success'] = "Add Exam Successfully.";
        header('location:page/detailAdmin.php?name='.$coursename);

    }
?>