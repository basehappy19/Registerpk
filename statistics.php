<?php
require('helper/server/db.php');

$countA = 0; 
$countB = 0;
$countC = 0;
$sql = "SELECT plan, COUNT(*) as total_students FROM students GROUP BY plan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $plan = $row["plan"];
        $totalStudents = $row["total_students"];
        $planCounts[$plan] = $totalStudents;
    }
}

if (isset($planCounts['วิทยาศาสตร์ – คณิตศาสตร์ : SMT'])) {
    $countA = intval($planCounts['วิทยาศาสตร์ – คณิตศาสตร์ : SMT']);
}

if (isset($planCounts['ภาษาอังกฤษ – คณิตศาสตร์'])) {
    $countB = intval($planCounts['ภาษาอังกฤษ – คณิตศาสตร์']);
}

if (isset($planCounts['การจัดการธุรกิจการค้าสมัยใหม่ : MOU CP ALL'])) {
    $countC = intval($planCounts['การจัดการธุรกิจการค้าสมัยใหม่ : MOU CP ALL']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถิติการสมัครเรียน | โรงเรียนภูเขียว</title>
    <?php require 'helper/source/icon.php'; ?>
    <link rel="stylesheet" href="helper/bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/5134196601.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="helper/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="font-family: Prompt, sans-serif;">
    <?php require 'helper/source/header.php' ?>
    <main>
        <div class="container">
            <p class="card-background" id="countsmt">จำนวนคนสมัครวิทยาศาสตร์ – คณิตศาสตร์ <?php echo $countA ?> คน</p>
            <p class="card-background" id="counteng">จำนวนคนสมัครภาษาอังกฤษ – คณิตศาสตร์ <?php echo $countB ?> คน</p>
            <p class="card-background" id="countmou">จำนวนคนสมัครการจัดการธุรกิจการค้าสมัยใหม่ <?php echo $countC ?> คน</p>
            <div class="card-background">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </main>

    <?php require 'helper/source/footer.php' ?>
    <?php require 'helper/source/script.php' ?>
    <script>
        AOS.init();
        var planData = <?php echo json_encode($planCounts); ?>;
        var labels = Object.keys(planData);
        var values = Object.values(planData);

        var countAData = <?php echo $countA ?>; 
        var countBData = <?php echo $countB ?>;
        var countCData = <?php echo $countC ?>;

        var countAInt = parseInt(countAData);
        var countBInt = parseInt(countBData);
        var countCInt = parseInt(countCData);
    
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['วิทยาศาสตร์ – คณิตศาสตร์ : SMT', 'ภาษาอังกฤษ – คณิตศาสตร์', 'การจัดการธุรกิจการค้าสมัยใหม่ : MOU CP ALL'],
                datasets: [{
                    label: 'จำนวนคนที่สมัครตามแผน',
                    data: [Math.floor(countAInt), Math.floor(countBInt), Math.floor(countCInt)],
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgb(81, 226, 144, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgb(81, 226, 144, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });
    </script>


</body>

</html>