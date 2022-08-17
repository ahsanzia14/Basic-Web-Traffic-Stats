<?php
/**
 * following PHP code should run on each request
 */

// lets require core classes and helper
require_once './inc/core.php';
// lets get required info
$ipAddress = getIpAddress(); // helper function
$visitedUrl = getCurrentUrl(); // helper function
$visitedAt = date('Y-m-d H:i:s'); // current datetime
// lets insert new record
$db = new Database();
$sql = "INSERT INTO web_traffic (ip_address, visited_url, visited_at) VALUES(:ip_address, :visited_url, :visited_at);";
$db->query($sql);
$db->bind(':ip_address', $ipAddress);
$db->bind(':visited_url', $visitedUrl);
$db->bind(':visited_at', $visitedAt);

$id = null;
if ($db->execute()) {
	$id = $db->lastInsertId();
	Session::setSession('id', $id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles.css">
	
	<title>Web Traffic</title>

	<script src="https://releases.jquery.com/git/jquery-git.min.js" type="application/javascript"></script>
</head>

<body>
	<h1>Visitor's Information</h1>
</body>

</html>

<script>
	// following block will run at every page
	$(function() {
		// lets get screen widht and height
		const screenSize = {
			width: window.screen.width,
			height: window.screen.height
		};
		// lets send ajax post request 
		$.post("/ajax.php", screenSize, function(data) {
			console.log(data);
		});
	});
</script>