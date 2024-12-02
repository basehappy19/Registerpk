<?php 
require 'helper/server/db.php'; 

$selectedRoom = isset($_GET['room']) ? $_GET['room'] : '';
$roomPrefix = ($selectedRoom !== '') ? "ห้อง $selectedRoom" : "ทุกห้อง";

$sql = "SELECT * FROM students";
if (!empty($selectedRoom) && $selectedRoom !== 'all') {
    $sql .= " WHERE room = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedRoom);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $stmt->close();
} else {
    $result = $conn->query($sql);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้สมัคร | โรงเรียนภูเขียว</title>
    <?php require 'helper/source/icon.php'; ?>
    <link rel="stylesheet" href="helper/bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/5134196601.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="helper/style.css">
</head>
<body style="font-family: Prompt, sans-serif;">
    <?php require 'helper/source/header.php' ?>
    <main>
        <div class="container">
            <div class="card-background mb-3" style="padding-top: 10px;" data-aos="zoom-in" data-aos-delay="150" data-aos-duration="1000">
                <h4 class="text-center mb-3">รายชื่อผู้สมัคร - <?php echo  $roomPrefix; ?></h4>
                <form class="d-xl-flex justify-content-xl-center" style="margin-bottom: 10px;" method="get">
                <div class="input-group input-group-sm d-flex d-xl-flex justify-content-end justify-content-xl-end"><span class="input-group-text" style="color: rgb(13,12,12);border-color: rgb(0,0,0); background-color: #f7f7f9;">แสดง</span>
                    <select class="form-select" required="" style="border-color: rgb(0,0,0); color: #888;" name="room">
                        <?php for ($roomNumber = 1; $roomNumber <= 12; $roomNumber++): ?>
                            <option value="<?php echo $roomNumber; ?>" <?php echo ($selectedRoom === (string)$roomNumber) ? 'selected' : ''; ?>>
                                ห้อง <?php echo $roomNumber; ?>
                            </option>
                        <?php endfor; ?>
                        <option value="" <?php echo ($selectedRoom === '') ? 'selected' : ''; ?>>ทุกห้อง</option>
                    </select>
                    <button class="btn btn-primary" type="submit" style="border-color: rgb(0,0,0);"><i class="bi bi-search"></i></button>
                </div>
            </form>
            </div>
            <div class="table-responsive card-background" style="padding-bottom: 10px;" data-aos="zoom-in" data-aos-delay="100" data-aos-duration="1000">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center text-dark" style="background: #ffe3e3;border-bottom: 2px solid rgb(0,0,0);">
                            <th style="width: 50px;">ลำดับ</th>
                            <th>รหัสนักเรียน</th>
                            <th>ชื่อ</th>
                            <th style="width: 75px;">ห้อง</th>
                            <th style="width: 75px;">เลขที่</th>
                            <th>แผนการเรียน</th>
                        </tr>
                    </thead>
                    <?php $i = 1; while($row = $result->fetch_assoc()): ?>
                    <tbody>
                        <tr class="text-black">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><?php echo $row['username'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td class="text-center"><?php echo $row['room'];?></td>
                            <td class="text-center"><?php echo $row['student_number'];?></td>
                            <td><?php echo $row['plan'];?></td>
                        </tr>
                    </tbody>
                    <?php $i++; endwhile; ?>
                </table>
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
    