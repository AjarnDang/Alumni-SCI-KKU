<?php
include('../template/header_admin.php'); 
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    <link href="assets/css/jqvmap.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.vmap.js" type="text/javascript"></script>
    <script src="assets/js/jquery.vmap.thai.js" type="text/javascript"></script>

    <style>
        body {background-color: #f5f5f5 !important;}
        #vmap {width: 100%; height: 800px; border-radius: 0.5em;}
        .map {margin: 5em 0;}
        @media only screen and (max-width: 1920px) {iframe {height:50em;}}
        @media only screen and (max-width: 992px) {iframe {height:31em;}}
        @media only screen and (max-width: 768px) {iframe {height:25em;}}
    </style>
</head>
<body>
<!--
    <div class="container map">  
        <div class="row">
            <div class="col-12">
                <div id="vmap"></div>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery('#vmap').vectorMap({
                            map: 'thai_en',
                            backgroundColor: '#ffd000',
                            color: '#000000',
                            hoverOpacity: 0.7,
                            selectedColor: '#999999',
                            enableZoom: true,
                            showTooltip: true,
                            scaleColors: ['#C8EEFF', '#006491'],
                            onRegionOver: function (event, code, region) {
                                //sample to interact with map
                                if (code == 'TH-50') {
                                // alert("You hover "+region);
                                    event.preventDefault();
                                }
                            },
                            onRegionClick: function (element, code, region) {
                                //sample to interact with map
                                var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();
                                alert(message);
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <div class="row mt-3 detail">
                <h5>เครือข่ายของเรา</h5>
                <div class="col-6">
                    ภาคตะวันออกเฉียงเหนือ
                </div>
                <div class="col-6">
                    ภาคกลาง
                </div>
            </div>
    </div> 
-->
<div class="container mt-5">
    <div class="bread-crump mb-3">
        <a href="home.php">หน้าหลัก</a> >
        <a href="#">เครือข่ายศิษย์เก่า</a>
      </div>
    <div class="row">
        <div class="col-lg-12">
            <iframe 
                width="100%" 
                height="auto" 
                src="https://datastudio.google.com/embed/reporting/acc3bab0-c8f2-48ac-b42d-7041683197de/page/AAUtC" 
                frameborder="0" 
                style="border:0" 
                allowfullscreen>
            </iframe>          
        </div>
    </div>
</div>

<?php include('../template/footer_users.php');  ?>
</body>
</html>