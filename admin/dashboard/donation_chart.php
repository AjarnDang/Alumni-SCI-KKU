<?php 
include('header_dashboard.php');
error_reporting(0);
?>
  <link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
  <!--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  -->
    <body>
    <?php
    require_once('../../db/connection.php');
    include('donation_nav.php');
    $p = (isset($_GET['p']) ? $_GET['p'] : '');
    if($p=='daily'){
      include('donation_r_daily.php');

    }elseif($p=='monthy'){
      include('donation_r_monthy.php');

    }elseif($p=='yearly'){
      include('donation_r_yearly.php');

    }elseif($p=='add'){
      include('donation_form.php');
      
    }elseif($p=='adddb'){
      include('donation_form_db.php');
      
    }else{
      include('donation_r_daily.php');
    }
    ?>
    
  </body>
</html>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<!--
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  -->
<?php include('DashboardScript.php') ?>
