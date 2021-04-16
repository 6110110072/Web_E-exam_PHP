<?php
session_start();
include('../include/server.php');
if (isset($_GET['name'])) {
    $coursename = $_GET['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new Exam</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        #outer {
            width: 100%;
            text-align: center;
        }

        .inner {
            display: inline-block;
        }
    </style>
    </head>

    <body>
        <div class="header">
            <h1>Add new Exam <?php echo $coursename ?></h1>
        </div>

        <form action="../AddExam_db.php?name=<?php echo $coursename ?>" method="post">
            <div class="input-group">
                <label for="Question">Question </label>

                <input type="text" name="Question" required><br><br>
                <label for="Choice1">Choice1 </label>
                <input type="text" name="Choice1" required><br><br>
                <label for="Choice2">Choice2 </label>
                <input type="text" name="Choice2" required><br><br>
                <label for="Choice3">Choice3 </label>
                <input type="text" name="Choice3" required><br><br>
                <label for="Choice4">Choice4 </label>
                <input type="text" name="Choice4" required><br><br>
                <br>
                <h3>Select Answers</h3><br>
                <div id="outer">
                <div class="form-group">
                <ol>
                        <div class="inner"><input type="radio" name="ans" value="1" required/>Choice1</div>
                        <div class="inner"><input type="radio" name="ans" value="2" required/>Choice2</div>
                        <div class="inner"><input type="radio" name="ans" value="3" required/>Choice3</div>
                        <div class="inner"><input type="radio" name="ans" value="4" required/>Choice4</div>
                </ol>
            </div>
                </div>
                <br>
            </div>
            <div class="input-group" style="text-align: center">
                <button type="submit" name="AddExam" class="btn">Add Question</button>
            </div>
        </form>

    </body>

</html>