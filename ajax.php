<?php
// ajax request only
if (empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
  // direct access denied
  if (realpath($_SERVER["SCRIPT_FILENAME"]) == __FILE__) {
    header("Location: /403");
    die;
  }
}

// lets require core classes and helper
require_once './inc/core.php';
// lets check if it is POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect posted data
  $width = (int) $_POST['width'];
  $height = (int) $_POST['height'];
  // simple check if values not defined
  if (empty($width) || empty($height)) {
    die("Invalid Input");
  }
  // lets make resolution string
  $screenSize = "{$width} x {$height}";
  // lets update related record
  $db = new Database();
  $sql = "UPDATE web_traffic SET screen_size = :screen_size WHERE id = :id;";
  $db->query($sql);
  $db->bind(':screen_size', $screenSize);
  $db->bind(':id', Session::getSession('id'));
  echo json_encode(['status' => $db->execute(), 'screen_size' => $screenSize]);
  die;
}
