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
	<h1>Web Traffic Logger</h1>
	<p>Click <a href="/traffic-info.php">here</a> to view basic info about website visitor.</p>
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

		const interval = 3 // 3 seconds
		let timeSpent = 0; // initial time spent
		// lets start time interval
		let intervalId = setInterval(stillHere, interval * 1000);

		/**
		 * send get request with time spent
		 */
		function stillHere() {
			timeSpent += interval;
			$.get("/ajax.php", {
				time_spent: timeSpent
			}, function(data) {
				console.log(data);
			});
		}

		document.addEventListener("visibilitychange", (e) => {
			if (document.visibilityState === 'visible') {
				if (!intervalId)
					intervalId = setInterval(stillHere, interval * 1000);
			} else {
				clearInterval(intervalId);
				intervalId = 0;
			}
		});

		/* $(window).on('focus', function() {
			if (!intervalId)
				intervalId = setInterval(stillHere, interval * 1000);
		});

		$(window).on('blur', function() {
			clearInterval(intervalId);
			intervalId = 0;
		}); */

		$(window).on('unload', function(e) {
			clearInterval(intervalId);
		});
	});
</script>