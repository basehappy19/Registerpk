<?php 

$username = $_SESSION['username'];

$check_plan_sql = "SELECT * FROM students WHERE username = '$username' AND plan = ''";
$check_plan_result = $conn->query($check_plan_sql);

if ($check_plan_result->num_rows > 0) {

} else {
    header("Location: info.php");
}
?>