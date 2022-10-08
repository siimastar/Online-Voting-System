<?php
session_start();
require_once('../connection.php');

if (empty($_SESSION['member_id'])) {
  header("location:access-denied.php");
}
?>

<?php

$positions = $conn->query("SELECT * FROM tbPositions")
  or die("There are no records to display ... \n" . $conn->error);
?>
  <?php

  if (isset($_POST['Submit'])) {

    $position = addslashes($_POST['position']);


    $result = $conn->query("SELECT * FROM tbCandidates WHERE candidate_position='$position'")
      or die(" There are no records at the moment ... \n");
  } else
    // do something

  ?>
