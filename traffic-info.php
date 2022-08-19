<?php
// lets require core classes and helper
require_once './inc/core.php';
// lets fetch traffic info from database
$db = new Database();
$sql = "SELECT * FROM web_traffic ORDER BY ip_address ASC, visited_at DESC;";
$db->query($sql);
$trafficInfo = $db->resultSet();
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
  <h1>Web Traffic Information</h1>

  <div class="traffic-info-section">
    <table class="traffic-info-table">
      <thead>
        <tr>
          <th>#ID</th>
          <th>IP Address</th>
          <th>Screen Size</th>
          <th>Visited URL</th>
          <th>Visited At</th>
          <th>Time Spent</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($trafficInfo as $index => $traffic) : ?>
          <tr>
            <td><?= $traffic->id ?></td>
            <td><?= long2ip($traffic->ip_address) ?></td>
            <td><?= $traffic->screen_size ?></td>
            <td><?= urldecode($traffic->visited_url) ?></td>
            <td><?= setDateFormat($traffic->visited_at) ?></td>
            <td><?= floor($traffic->time_spent / 60) . ' Min ' . ($traffic->time_spent % 60) . ' Sec' ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

</body>

</html>