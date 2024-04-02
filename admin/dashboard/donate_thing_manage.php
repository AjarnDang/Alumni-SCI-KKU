<?php
include('header_dashboard.php');
error_reporting(0);
if (strlen($_SESSION['username']) == 'admin') {
    header('location:../../login-system/login_form.php');
} else {
    if ($_GET['action'] == 'del' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($conn, "UPDATE donate_stuff set Is_Active='0' where item_id='$id'");
        $msg = "ลบข้อมูลเสร็จสิ้น";
    }
    //restore
    if ($_GET['resid']) {
        $id = intval($_GET['resid']);
        $query = mysqli_query($conn, "UPDATE donate_stuff set Is_Active='1' where item_id='$id'");
        $msg = "กู้คืนข้อมูลเสร็จสิ้น";
    }

    //Forever delete
    if ($_GET['action'] == 'parmdel' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($conn, "DELETE from donate_stuff where item_id='$id'");
        $delmsg = "ลบข้อมูลเสร็จสิ้น";
    }
?>
    <link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
    <body>
        <div class="container-fluid">
            <div class="bread-crump pt-2">
                <a href="adminDashboard.php">แดชบอร์ด</a> >
                <a href="#">บริจาคสิ่งของ</a> >
                <a href="#">จัดการรายการบริจาคสิ่งของ</a>
            </div>
            <div class="pt-2 header-product">
                <strong>จัดการรายการบริจาคสิ่งของ</strong>
            </div>
            <hr>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!---Success Message--->
                    <?php if ($msg) { ?>
                        <div class="alert alert-success" role="alert">
                            <strong>สำเร็จ!</strong> <?php echo htmlentities($msg); ?>
                        </div>
                    <?php } ?>

                    <!---Error Message--->
                    <?php if ($delmsg) { ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>ขออภัย</strong> <?php echo htmlentities($delmsg); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <th>#</th>
                            <th>รูปภาพ</th>
                            <th>ของที่ต้องการบริจาค</th>
                            <th>รายระเอียด</th>
                            <th>รูปแบบการจัดส่ง</th>
                            <th>ยืนยัน</th>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT * from donate_stuff 
                                                          where Is_Active=1
                                                        ");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                    <td><img width="100" src="postimages/<?php echo $row['Picture']; ?>" alt=""></td>
                                    <td><?php echo $row['item']; ?></td>
                                    <td><?php echo $row['details']; ?></td>
                                    <td><?php echo $row['mad']; ?></td>
                                    <td><a href="donate_thing_manage.php?rid=<?php echo htmlentities($row['item_id']); ?>&&action=del">
                                        <span class="glyphicon glyphicon-trash"></span>ยืนยัน</a>
                                    </td>
                                </tr>
                            <?php $cnt++;
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h5 style="font-size: 20px;" class="mb-2"></i>
                        ประวัติการบริจาค
                    </h5>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <th>#</th>
                            <th>รูปภาพ</th>
                            <th>ของที่ต้องการบริจาค</th>
                            <th>รายระเอียด</th>
                            <th>รูปแบบการจัดส่ง</th>
                            <th>ยืนยัน</th>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT * from donate_stuff
                                                          where Is_Active=0
                                                        ");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $cnt; ?></th>
                                    <td><?php echo $row['Picture']; ?></td>
                                    <td><?php echo $row['item']; ?></td>
                                    <td><?php echo $row['details']; ?></td>
                                    <td><?php echo $row['fullName']; ?></td>
                                    <td><?php echo $row['tel']; ?></td>
                                    <td><?php echo $row['mad']; ?></td>
                                    <td><a href="donate_thing_manage.php?resid=<?php echo htmlentities($row['item_id']); ?>"><svg width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M480 256c0 123.4-100.5 223.9-223.9 223.9c-48.86 0-95.19-15.58-134.2-44.86c-14.14-10.59-17-30.66-6.391-44.81c10.61-14.09 30.69-16.97 44.8-6.375c27.84 20.91 61 31.94 95.89 31.94C344.3 415.8 416 344.1 416 256s-71.67-159.8-159.8-159.8C205.9 96.22 158.6 120.3 128.6 160H192c17.67 0 32 14.31 32 32S209.7 224 192 224H48c-17.67 0-32-14.31-32-32V48c0-17.69 14.33-32 32-32s32 14.31 32 32v70.23C122.1 64.58 186.1 32.11 256.1 32.11C379.5 32.11 480 132.6 480 256z" /></svg>
                                        </a> &nbsp;
                                        <a href="donate_thing_manage.php?rid=<?php echo htmlentities($row['item_id']); ?>&&action=parmdel" title="Delete forever"><i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                    </td>
                                </tr>
                                <?php $cnt++;
                                } ?>

                            </tbody>
                        </table>
                </div>
            </div>



        </div>

    </body>
    <?php include('DashboardScript.php') ?>
<?php } ?>