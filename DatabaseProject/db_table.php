<!DOCTYPE html>
<script src="hello.js"></script>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?php include 'db_connection.php'; ?>
<html>


<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="UTF-8">
    <title>Covid-19 Report</title>
</head>


<body style="background-color:DimGrey;">
<br>
<h1 style="background-color:White; padding: 40px 50px;">All Report</h1><br>
&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="history.back()" class="btn btn-primary">Go Back</button>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="show_sevenday.php"><button class="btn btn-primary">Show Lastest week</button></a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="covid-app/"><button  class="btn btn-success" >Insert</button></a>
    <center>
        <table class="table table-dark">
            <?php
            $sum = (int)"0";
            $count = 0;
            $sql = "SELECT * FROM province_covid ";
            $result = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function
            echo "<br>";

            while ($row = mysqli_fetch_assoc($result)) { // Important line !!! Check summary get row on array ..
                echo "<tr>";

                if ($count == 0) {
                    $count += 1;
                    foreach ($row as $field => $value) {

                        echo "<th><center>" . $field . "</center></th>";
                    }
                }
                echo "</tr>";
                echo "<tr>";
                foreach ($row as $field => $value) {
                    echo "<td><center>" . $value . "</center></td>";
                }


                echo "</tr>";
            }
            echo "</table>";
            ?>

        </table>
    </center>


</body>

</html>

<?php
mysqli_close($conn);

?>