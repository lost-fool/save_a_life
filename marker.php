<?php

include 'phpconfig.php';
$conn=opencon();
echo "<br/>";
$sql = "SELECT column_id, column_contactnumber, column_latitude, column_longitude FROM user2Details_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        echo "Id: " . $row["column_id"]. " - Number: " . $row["column_contactnumber"]. " - Latitude: " . $row["column_latitude"]." - Longitude: " . $row["column_longitude"]. "<br>";
?>
        <script type="text/javascript">
        	var waypts = [];
        	waypts.push({
          		location: {lat:<?php echo $row["column_latitude"] ?>,lng:<?php echo $row["column_longitude"] ?>},
          		stopover: true
         	});
        	
        </script>
<?php
    }
} 
else 
{
    echo "0 results";
}
?>