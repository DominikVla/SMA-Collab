<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<?php
// Start the session
session_start();

// Get parameters from login page
$email    = $_POST['email'];
$password = $_POST['password'];

// Try and login
$status = loginDB($email, $password);
if ($status == "loggedIn") {
	processGoodLogin($status);		// process good login
} else {
	processBadLogin($status);		// process bad login
}

//
// Test function to see if login works
//


//
// Test function to see if login works
//
function loginDB($email, $password) {
	$conn = getDBConnection();
	$status = checkCreds($conn, $email, $password);
	return $status;
}

//
// Get database connection
//
function getDBConnection() {
	// get connection to MySQL database
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
	return $conn;
}

//
// check if credentials passed are in db
//
function checkCreds($conn, $email, $password) {
	$sql = "SELECT * FROM sma_logins";
	$sql = $sql . " where email='" . $email . "' AND password='" . $password . "';";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)){
	  $region_ = $row['Region'];
	}



	$_SESSION["selectedRegion"] = $region_;  //writes the region to the session 
	if (mysqli_num_rows($result) == 1) {
		$status = "loggedIn";
		$success ="successful Login!";



	} else {
		$status = "loggedOut";
		$success = "unsuccessful Login";
	}

	// Close the connection 
	mysqli_close($conn);


	
	$file = 'log.txt';
	$ip = $_SERVER["REMOTE_ADDR"];
	$date = date('d-m-Y H:i:s');

	$current = file_get_contents($file);

	$newLine=  '###################################################################################################' . "\r\n" .' attempted to log in from IP Address of ' . $ip . "\r\n" . 'Date & Time: ' . $date . "\r\n" . 'Successful Login: '. $success  . "\r\n" . ' Email:' . $email. "\r\n" .'###################################################################################################' . "\r\n" . "\r\n";

	$current = $current . $newLine;
	file_put_contents($file, $current);




	return $status;	
}

//
// Process good login
//
function processGoodLogin($status) {
	$_SESSION["status"] = $status;
    $_SESSION['login_error_msg'] = "";
    echo "No Problems with *";
    $email = $_POST['email'];
    if ($email === "admin@email.com") {
		header("Location: home2.php");
	} else {
	header("Location:Home.php");
	}
	exit();
}

//
// Process bad login
//
function processBadLogin($status) {
	$_SESSION["status"] = $status;
	$_SESSION['login_error_msg'] = "Sorry, that user name or password is incorrect. Please try again.";
	header("Location: index.php");
	exit();		
}

?>
