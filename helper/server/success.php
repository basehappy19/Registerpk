<?php
require('db.php');

if (!isset($_SESSION['username']) || $_SESSION['username'] != true) {
    header("Location: ../../regis.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['plan'])) {
    $valid_plans = array("วิทยาศาสตร์ – คณิตศาสตร์ : SMT", "ภาษาอังกฤษ – คณิตศาสตร์", "การจัดการธุรกิจการค้าสมัยใหม่ : MOU CP ALL");
    if (in_array($_POST['plan'], $valid_plans)) {
        $plan = $_POST['plan'];
        $name = $_SESSION['name'];

        $check_sql = "SELECT * FROM students WHERE name = '$name'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $update_sql = "UPDATE students 
                           SET plan = '$plan'
                           WHERE name = '$name'";
            
            if ($conn->query($update_sql) === TRUE) {
                $_SESSION['plan'] = $plan;
                header("location: ../../info.php");
                exit();
            } else {
                
            }
        } else {
            
        }
    } else {
        
        exit();
    }
} else {
    header("location: ../../regis.php");
    exit();
}
?>
