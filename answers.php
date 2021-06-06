<!DOCTYPE html>
<html>
    <head>
        <title>Point-o-meter</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital@1&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital@1&family=Rajdhani&display=swap" rel="stylesheet">    </head>
    <body>
        <h1>POINT-O-METER</h1>
        <div id="question-container" class="container">
            <h5 id="question-header">Question:</h5>
            <p id="question">Countries containing the letter 'G'</p>
        </div>
        <table id="answers" class="table table-hover">
            <thead>
                <tr>
                    <th>Answer</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = '';
            $DATABASE_NAME = 'pointometer';
            
            $mysqli = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            $question_id = $_GET['id'];
            $query = "SELECT * FROM `question-".$question_id."` ORDER BY score DESC;";
            
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                $answer = $row["answer"];
                $score = $row["score"];
            
                echo '<tr>';
                    if ($score == 0) {
                        echo '<td><b>'.$answer.'</b></td>
                        <td><b>'.$score.'</b></td>';
                    } else {
                        echo '<td>'.$answer.'</td>
                        <td>'.$score.'</td>';
                    }
                echo '</tr>';
                }
                $result->free();
            }
            ?>
            </tbody>
        </table>
    </body>
</html>