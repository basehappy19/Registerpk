<header>
    <nav class="navbar navbar-light navbar-expand-md sticky-top" style="padding: 0; border-bottom-width: 2px; border-bottom-style: solid; box-shadow: 0px 2px #efb8f291">
        <div class="container">
            <a class="navbar-brand" href="./">
                <img src="helper/media/bannerlogo.png" width="200px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navcol-1"
                aria-controls="navcol-1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-xl-flex justify-content-xl-end" id="navcol-1">
                <ul class="navbar-nav ms-auto" style="font-size: 17px;">
                    <li class="nav-item">
                        <a class="nav-link" href="account.php"><i class="far fa-edit"></i>&nbsp;สมัครเรียน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="students.php"><i class="bi bi-person-badge"></i>&nbsp;รายชื่อผู้สมัคร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistics.php"><i class="bi bi-bar-chart-steps"></i>&nbsp;สถิติการสมัครเรียน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="regulations.php"><i class="fas fa-book"></i>&nbsp;อ่านระเบียบการ</a>
                    </li>
                    <?php
                        if (isset($_SESSION['username'])) {
                            echo '<li class="nav-item"><a class="nav-link" href="helper/server/logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;ออกจากระบบ</a></li>';
                        ?>
                            
                        <?php
                        } else {
                        ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
