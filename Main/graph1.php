<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>


<?php
function debug_to_console($putout) {
    $output = $putout;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
$servername = "localhost";
$username = "111117";
$password = "saltaire";
$dbname = "111117";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$graph1_y = array();
$graph1_name = array();

$sql = "SELECT * FROM sma WHERE Region='$sel_area'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    //$browsers = $row['Browser'];
    $x = $row['Name'];
    //echo $x .","; 
    $y = $row['6Quarters'];
    array_push($graph1_name, $x);
    array_push($graph1_y, $y);
    //debug_to_console($x);
   
  }
}else{
  echo"0 results found!";
}
mysqli_close($conn);
?>

<script src="https://cdn.plot.ly/plotly-latest.min.js">//Lib</script>
<div id="myPlot" style="width:100%;max-width:700px"></div>

<script>



//var graph1_name = ["name1","name2","name3","name4","name5","name6","name7","name8","name9","name10"];
var graph1_name = [<?php echo '"'.implode('","', $graph1_name).'"' ; ?>]
var graph1_y = [<?php echo '"'.implode('","', $graph1_y).'"' ; ?>];


var data = [{
  x:graph1_name,
  y:graph1_y,
  type:"bar"
}];

var layout = {title:"employees to sales"};

Plotly.newPlot("myPlot", data, layout);
</script>