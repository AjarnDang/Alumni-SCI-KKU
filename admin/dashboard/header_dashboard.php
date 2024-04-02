<?php 
session_start();
include('../../db/connection.php');
if (!isset($_SESSION['username'])) {
    header("location:../../login-system/login_form.php");   
} ?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบจัดการเว็บไซต์ศิษย์เก่า | คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น</title>
    <meta name="description" content="ระบบจัดการเว็บไซต์ | คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../../assets/img/sci_logo.png">
    <link rel="shortcut icon"    href="../../assets/img/sci_logo.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../../assets/css/header_dashboard.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
</head>
<body>
<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>	
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><p class="menu-title p-0 m-0">ยินดีต้อนรับ <?php echo $_SESSION['username']; ?></p></li>
                    <li><a href="../admin_home.php"><i class="menu-icon fa fa-paper-plane"></i>หน้าหลัก</a></li>
                    <li class="<?= ($activePage == 'adminDashboard') ? 'active' : ''; ?>">
                        <a href="./adminDashboard.php"><i class="menu-icon fa fa-laptop"></i>แดชบอร์ด</a>
                    </li>

                    <!--<li class="menu-title">ระบบจัดการสินค้าที่ระลึก</li>--><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown
                        <?= ($activePage == 'product_dashboard') ? 'active' : ''; ?>
                        <?= ($activePage == 'product_formorder') ? 'active' : ''; ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-cogs"></i>สินค้าที่ระลึก</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i>              <a href="product_dashboard.php">จัดการสินค้าที่ระลึก</a></li>
                            <li><i class="fa fa-bars"></i>                  <a href="product_formorder.php">รายการสั่งซื้อ</a></li>
                            <li><i class="fa fa-id-card-o"></i>             <a href="#">สต็อกสินค้า</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown
                        <?= ($activePage == 'news_ac_dashboard') ? 'active' : ''; ?>
                        <?= ($activePage == 'news_category_add') ? 'active' : ''; ?>
                        <?= ($activePage == 'news_subcategory_add') ? 'active' : ''; ?>
                        <?= ($activePage == 'news_news_add') ? 'active' : ''; ?>
                        <?= ($activePage == 'news_category_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'news_subcategory_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'news_news_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'news_comment_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'news_comment_unapprove') ? 'active' : ''; ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-table"></i>ข่าวสาร</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i>          <a href="news_ac_dashboard.php">ภาพรวมระบบ</a></li>
                            <li><i class="fa fa-th"></i>                    <a href="news_category_add.php">เพิ่มหมวดหมู่</a></li>
                            <li><i class="fa fa-th"></i>                    <a href="news_subcategory_add.php">เพิ่มหมวดหมู่ย่อย</a></li>
                            <li><i class="fa fa-th"></i>                    <a href="news_news_add.php">เพิ่มข่าวสาร</a></li>
                            <li><i class="fa fa-file-word-o"></i>           <a href="news_category_manage.php">จัดการหมวดหมู่</a></li>
                            <li><i class="fa fa-file-word-o"></i>           <a href="news_subcategory_manage.php">จัดการหมวดหมู่ย่อย</a></li>
                            <li><i class="fa fa-file-word-o"></i>           <a href="news_news_manage.php">จัดการข่าวสาร</a></li>
                            <li><i class="fa fa-comments"></i>              <a href="news_comment_manage.php">จัดการคอมเมนท์</a></li>
                            <li><i class="fa fa-comments"></i>              <a href="news_comment_unapprove.php">จัดการคอมเมนต์ที่ยังไม่อนุมัติ</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown
                        <?= ($activePage == 'activity_calender') ? 'active' : ''; ?>
                        <?= ($activePage == 'activity_category_add') ? 'active' : ''; ?>
                        <?= ($activePage == 'activity_subcategory_add') ? 'active' : ''; ?>
                        <?= ($activePage == 'activity_add') ? 'active' : ''; ?>
                        <?= ($activePage == 'activity_category_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'activity_subcategory_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'activity_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'activity_comment_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'activity_comment_unapprove') ? 'active' : ''; ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-th"></i>กิจกรรม</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-th"></i>                    <a href="activity_calender.php">ปฎิทินกิจกรรม</a></li>
                            <li><i class="fa fa-th"></i>                    <a href="activity_category_add.php">เพิ่มหมวดหมู่</a></li>
                            <li><i class="fa fa-th"></i>                    <a href="activity_subcategory_add.php">เพิ่มหมวดหมู่ย่อย</a></li>
                            <li><i class="fa fa-th"></i>                    <a href="activity_add.php">เพิ่มกิจกรรม</a></li>
                            <li><i class="fa fa-file-word-o"></i>           <a href="activity_category_manage.php">จัดการหมวดหมู่</a></li>
                            <li><i class="fa fa-file-word-o"></i>           <a href="activity_subcategory_manage.php">จัดการหมวดหมู่ย่อย</a></li>
                            <li><i class="fa fa-file-word-o"></i>           <a href="activity_manage.php">จัดการกิจกรรม</a></li>
                            <li><i class="fa fa-comments"></i>              <a href="activity_comment_manage.php">จัดการคอมเมนท์</a></li>
                            <li><i class="fa fa-comments"></i>              <a href="activity_comment_unapprove.php">จัดการคอมเมนต์ที่ยังไม่อนุมัติ</a></li>
                        </ul>
                    </li>

                    <!--<li class="menu-title">Icons</li>--><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown
                        <?= ($activePage == 'community_dashboard') ? 'active' : ''; ?>
                        <?= ($activePage == 'community_category_add') ? 'active' : ''; ?>
                        <?= ($activePage == 'community_topic_add') ? 'active' : ''; ?>
                        <?= ($activePage == 'community_topic_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'community_comment_manage') ? 'active' : ''; ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-tasks"></i>คอมมูนิตี้</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i>          <a href="community_dashboard.php">ภาพรวมระบบ</a></li>
                            <li><i class="fa fa-th"></i>                    <a href="community_category_add.php">จัดการหมวดหมู่</a></li>
                            <li><i class="fa fa-th"></i>                    <a href="community_topic_add.php">เพิ่มหัวข้อ</a></li>                              
                            <li><i class="fa fa-file-word-o"></i>           <a href="community_topic_manage.php">จัดการหัวข้อ</a></li>
                            <li><i class="fa fa-comments"></i>              <a href="community_comment_manage.php">จัดการคอมเมนท์</a></li>
                        </ul>
                    </li>
                    
                    <li class="menu-item-has-children dropdown
                        <?= ($activePage == 'hof_overview') ? 'active' : ''; ?>
                        <?= ($activePage == 'hof_dashboard') ? 'active' : ''; ?>
                        <?= ($activePage == 'hof_add') ? 'active' : ''; ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-trophy"></i>ศิษย์เก่าดีเด่น</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i>  <a href="hof_overview.php">ภาพรวมระบบ</a></li>
                            <li><i class="menu-icon fa fa-area-chart"></i>  <a href="hof_dashboard.php">จัดการข้อมูล</a></li>
                            <li><i class="menu-icon fa fa-pie-chart"></i>   <a href="hof_add.php">เพิ่มข้อมูล</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown
                        <?= ($activePage == 'alumni_overview') ? 'active' : ''; ?>
                        <?= ($activePage == 'alumni_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'alumni_add') ? 'active' : ''; ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-user"></i>ศิษย์เก่า</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-map-o"></i>       <a href="alumni_overview.php">ภาพรวมระบบ</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i> <a href="alumni_manage.php">จัดการศิษย์เก่า</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i> <a href="alumni_add.php">เพิ่มศิษย์เก่า</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown
                        <?= ($activePage == 'donate_overview') ? 'active' : ''; ?>
                        <?= ($activePage == 'donate_thing_manage') ? 'active' : ''; ?>
                        <?= ($activePage == 'donation_chart') ? 'active' : ''; ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-user"></i>บริจาค</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-street-view"></i> <a href="./donate_overview.php">ภาพรวมระบบ</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i> <a href="./donate_thing_manage.php">บริจาคสิ่งของ</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i> <a href="./donation_chart.php">บริจาคเงิน</a></li>
                        </ul>
                    </li>

                    <li class="menu-title"><p class="menu-title p-0 m-0">เครื่องมือเพิ่มเติม</p></li>
                    <li class="<?= ($activePage == 'carousel_manage') ? 'active' : ''; ?>"><a href="carousel_manage.php"><i class="menu-icon fa fa-exclamation-circle"></i>จัดการหน้าเว็บไซต์</a></li>
                    <li class="<?= ($activePage == 'admin_guide') ? 'active' : ''; ?>"><a href="admin_guide.php"><i class="menu-icon fa fa-exclamation-circle"></i>คู่มือการใช้งาน</a></li>
                    <li class=""><a href="../../login-system/logout.php">
                        <i class="menu-icon fa fa-glass"></i>
                            ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
   <!-- Right Panel -->
   <div id="right-panel" class="right-panel">




        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./adminDashboard.php"><img src="https://sc2.kku.ac.th/office/sc-devav/templates/kku/images/logo.png" alt="Logo" width="200"> </a>
                    <a class="navbar-brand hidden" href="./adminDashboard.php"><img src="https://sc2.kku.ac.th/office/sc-devav/templates/kku/images/logo.png" alt="Logo" width="200"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    <!--
                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="https://thumbs.dreamstime.com/b/user-icon-vector-people-profile-person-illustration-business-users-group-symbol-male-195160429.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="https://thumbs.dreamstime.com/b/user-icon-vector-people-profile-person-illustration-business-users-group-symbol-male-195160429.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="https://thumbs.dreamstime.com/b/user-icon-vector-people-profile-person-illustration-business-users-group-symbol-male-195160429.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="https://thumbs.dreamstime.com/b/user-icon-vector-people-profile-person-illustration-business-users-group-symbol-male-195160429.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        -->
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="https://thumbs.dreamstime.com/b/user-icon-vector-people-profile-person-illustration-business-users-group-symbol-male-195160429.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>โปรไฟล์ของฉัน</a>
                            <!--
                                <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>
                                <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>
                            -->
                            <a class="nav-link" href="../../login-system/logout.php"><i class="fa fa-power -off"></i>ออกจากระบบ</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->