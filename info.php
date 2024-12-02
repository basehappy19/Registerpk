<?php
require('helper/server/db.php');

if (!isset($_SESSION['username']) || $_SESSION['username'] != true) {
    header("Location: regis.php");
    exit();
}

$username = $_SESSION['username'];

$check_plan_sql = "SELECT username, plan FROM students WHERE username = ? AND plan IS NOT NULL";
$check_plan_result = $conn->prepare($check_plan_sql);
$check_plan_result->bind_param("s", $username);

if ($check_plan_result->execute()) {
    $check_plan_result->store_result();

    if ($check_plan_result->num_rows > 0) {
        $check_plan_result->bind_result($fetched_username, $plan);
        $check_plan_result->fetch();

        switch ($plan) {
            case 'วิทยาศาสตร์ – คณิตศาสตร์ : SMT':
                $img_src = '<img class="img-fluid card-img-top2 info" src="helper/plan/sci.gif">';
                $detail_plan = '
                    <li>GPAX ตั้งแต่ 2.75 <span class="badge bg-success">ผ่านเกณฑ์</span> </li>
                    <li>GPA วิชาคณิตศาสตร์ ตั้งแต่ 2.5 <span class="badge bg-success">ผ่านเกณฑ์</span> </li>
                    <li>GPA วิชาคณิตศาสตร์ ตั้งแต่ 2.5 <span class="badge bg-success">ผ่านเกณฑ์</span> </li>
                    <li>ผลการเรียน ติด 0 ร มส มผ <span class="badge bg-success">ไม่มี</span> </li>
                ';
                break;

            case 'ภาษาอังกฤษ – คณิตศาสตร์':
                $img_src = '<img class="img-fluid card-img-top2 info2" src="helper/plan/eng.gif">';
                $detail_plan = '<li>GPAX ตั้งแต่ 2.75 <span class="badge bg-success">ผ่านเกณฑ์</span> </li>';
                break;

            case 'การจัดการธุรกิจการค้าสมัยใหม่ : MOU CP ALL':
                $img_src = '<img class="img-fluid card-img-top2 info3" src="helper/plan/mou.gif">';
                $detail_plan = '<li>ผลการเรียน ติด 0 ร มส มผ <span class="badge bg-success">ไม่มี</span> </li>';
                break;

            default:
                header("Location: account.php");
                exit();
        }
    } else {
        header("Location: account.php");
        exit();
    }
} else {
    header("Location: account.php");
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการสมัคร | โรงเรียนภูเขียว</title>
    <?php require 'helper/source/icon.php'; ?>
    <link rel="stylesheet" href="helper/bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/5134196601.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="helper/style.css">
</head>
<body>
    <?php require('helper/source/header.php'); ?>
    <main>
        <div class="container">
            <div id="card--info" class="card-background" data-aos="zoom-in" data-aos-delay="150" data-aos-duration="1000">
                <h4>ข้อมูลผู้สมัคร</h4>
                <?php if (isset($_SESSION['username'])): ?>
                    <div><span>รหัสนักเรียน : </span><?php echo $_SESSION['username']; ?></div>
                    <div><span>ชื่อ - สกุล : </span><span><?php echo $_SESSION['name']; ?></span><span> ห้อง : 3/</span><?php echo $_SESSION['room']; ?></div>
                    <span><?php echo $_SESSION['name']; ?></span>
                    <span> เกรดเฉลี่ย : </span><span class="badge bg-secondary gpa">5 เทอม <?php echo $_SESSION['grade']; ?></span> 
                    <span class="badge bg-secondary gpa">คณิต <?php echo $_SESSION['math']; ?></span> 
                    <span class="badge bg-secondary badge bg-secondary gpa">วิทย์ <?php echo $_SESSION['sci']; ?></span>
                    <div><span>คะแนนความประพฤติ : </span><span class="badge bg-warning"><?php echo $_SESSION['point']; ?></span></div>
                    <?php if ($_SESSION['zero'] == 1): ?>
                        <div><span>ติด 0 ร มส มผ : </span> <span class="badge bg-danger">มี</span></div>
                    <?php else: ?>
                        <div><span>ติด 0 ร มส มผ : </span> <span class="badge bg-success">ไม่มี</span></div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <hr>
            <div class="card-background mb-3" data-aos="zoom-in" data-aos-delay="150" data-aos-duration="1000">
                <h4 class="mb-5">แผนการเรียนที่สมัคร</h4>
                <div class="row mb-4">
                    <div class="col-md-5">
                        <div class="img-fluid"><?php echo $img_src; ?></div>
                    </div>
                    <div class="col-md-7 mt-3">
                        <p id="p-plan--info">แผนการเรียน<?php echo $plan; ?> </p>
                        <ul>
                            <?php echo $detail_plan; ?>
                        </ul>
                    </div>
                </div>
                <div>
                    <hr>
                    <p>หากต้องการเปลี่ยนแปลงแผนการเรียนให้นักเรียนส่งแบบฟอร์ม <a href="https://drive.google.com/file/d/17p5Unp99m6RwB53ny6BSSKGPxJb9n6fU/view?usp=sharing" target="_blank">นร.01.1</a> ที่ห้องวิชาการ โรงเรียนภูเขียว</p>
                </div>
            </div>
        </div>
    </main>
    <?php require 'helper/source/footer.php' ?>
    <?php require 'helper/source/script.php' ?>
    <script>
        AOS.init();
    </script>
</body>
</html>
