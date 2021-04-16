<?php
	session_start();
	include('include/server.php');
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

	if ($_POST['submit']) {

		$question = array();
		$score = 0;
		$num = 0;

		$sql_exam = "SELECT * FROM exam WHERE coursename='$coursename'";
        $query = mysqli_query($conn, $sql_exam);
        $result = mysqli_fetch_all($query);

        for ($i = 0; $i < sizeof($result); $i++) {
			array_push($question,$_POST['q'.($i+1)]);
		}
		foreach($question as $ques){
			if($ques == $result[$num][6]){
				$score++;
			}
			$num++;
		}
		$updatescore = "UPDATE user SET $coursename=$score WHERE username='$username'";
        mysqli_query($conn, $updatescore);

		$_SESSION['score'] = "You score is " . $score . "/".$num;

		header('location:page/Pretestexam.php?coursename=' . $coursename . "&" . "username=" . $username);
	}
?>