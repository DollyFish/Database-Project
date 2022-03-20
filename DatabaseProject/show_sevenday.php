<!DOCTYPE html>
<script src="hello.js"></script>
<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Covid-19 Report</title>
</head>


<body style="background-color:DimGrey;">
    
    <center>
    <br>
        <h1 style="background-color:White; padding: 20px 50px;">Lastest week</h1>
    </center>
    
    <div class="container">
        <table class="table table-dark">
        <button onclick="history.back()" class="btn btn-primary">Go Back</button>
            

            <?php include 'db_connection.php';



$count=  0;
$counter_count = 0;
$sql = "SELECT * FROM province_covid ";
$result = mysqli_query($conn, $sql);
$num_column = mysqli_num_fields($result);// First parameter is just return of "mysqli_connect()" function
$results = mysqli_query($conn, $sql);
echo "";

while ($row = mysqli_fetch_row($result)) { // Important line !!! Check summary get row on array ..
    $p_total_sum= 0;
    $sum_count = 0;
    $total_sum = 0;

    foreach ($row as $field => $value) {

    if ($sum_count >= 2){
    $total_sum += (int)$value;
    }
    if ($sum_count == $num_column-8){
        $p_total_sum = $total_sum;
    }

    $sum_count += 1;

 }

    echo ("<tr>");

    while ($rows = mysqli_fetch_assoc($results)) {
    if ($counter_count ==0){
        $counter_count +=1;
            foreach ($rows as $fields => $values) {
            if ($count >= $num_column-7 || $count == 0 || $count == 1 || $count == 2){
                
                if ($count == 2){
                    
                    echo "<th  class = 'col'> ยอดรวมก่อนหน้า </th>";
                }
                else{echo "<th  class = 'col'>".$fields."</th>";}
                
               
                   

            }
            $count += 1;
            
         }
         echo "<th  class = 'col'> ยอดรวม </th>";

    }}
    echo"</tr><tr>";
    echo ("<th>$row[0]</th>
    <th>$row[1]</th>"  
    );
    
    
    



    for($i = $num_column-8; $i <= $num_column-1; $i+=1){
    if ($i == $num_column-8){
        echo "<td scope='row'><center>".$p_total_sum."</center></td>";
    }
    else{
        if($row[$i] == null){
            $row[$i] = 0;

        }
        echo "<td scope='row'>".$row[$i]."</td>";
    }

    }
    echo "<td>".$total_sum."</td>";
    $sum = 0;
    echo "</tr>";
}
echo "</table></div>";





?>
            

</body>

</html>