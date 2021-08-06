<?php


  require_once('../connect.php');
  require_once('../googleLogin/config.php');
  date_default_timezone_set('Asia/Kolkata');
  $date =  date(DATE_COOKIE).' '.date('a');
  // echo $date;
  $md = md5($date);
  // echo '<br>'.$md;
  $dbauth = isset($_SESSION['userid']);
  if($dbauth)
  {
      $usertype = $_SESSION['usertype'];
      if($usertype==="user")
      {
          header('Location:http://localhost/fprjct/index.php');
      }
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        
            Admin Panel
        
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    
    <script type="text/javascript">
        var host = "bootadmin.org";
        if ((host == window.location.host) && (window.location.protocol != "https:"))
            window.location.protocol = "https";
    </script>

   
    <!-- Le CSS
    ================================================== -->
    <link rel="stylesheet" href="https://bootadmin.org/style/vendor/library.min.css">
    <link rel="stylesheet" href="https://bootadmin.org/style/vendor/jqueryui-flat/jquery-ui.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    
    <link rel="stylesheet" href="https://bootadmin.org/style/core/style.min.css">

   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    

	<!-- Le Favicons
	================================================== -->
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
</head>

<body id="landing" class="sidebar-open">
<div class="loading">
    <div class="loading-center"><img src="https://bootadmin.org/images/loading/map.gif" alt="Loading" /></div>
</div>
<div class="page-container animsition">
    <div id="dashboardPage">
        

<!-- Main Menu -->
<div class="topbar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 hidden-xs">
                <div class="logo">
                    <a href="/">
                        <span class="logo-emblem"><img src="https://bootadmin.org/images/boot.png" alt="BA" /></span>
                        <span class="logo-full">RESTAURANT</span>
                    </a>
                </div>
                <a href="#" class="menu-toggle wave-effect">
                    <i class="feather icon-menu"></i>
                </a>
            </div>
            <div class="col-md-7 text-right">
                <ul>
                    <!-- Profile Menu -->
                    <li class="btn-group user-account">
                        <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-content">
                                <div class="user-name">Admin</div>
                                <div class="user-plan">one of the admin</div>
                            </div>
                            <div class="avatar">
                                <img src="profile.png" alt="profile" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#" class="animsition-link dropdown-item wave-effect"><i class="feather icon-user"></i> Profile</a></li>
                            <li><a href="#" class="animsition-link dropdown-item wave-effect"><i class="feather icon-dollar-sign"></i> Billing</a></li>
                            <li><a href="#" class="animsition-link dropdown-item wave-effect"><i class="feather icon-settings"></i> Settings</a></li>
                            <li><a href="http://localhost/fprjct/googleLogin/logout.php" class="animsition-link dropdown-item wave-effect"><i class="feather icon-log-in"></i> Logout</a></li>
                        </ul>
                    </li>
                    <!-- Offcanvas Menu -->
                    <li>
                        <a href="#" class="btn wave-effect offcanvas-toggle"><i class="feather icon-settings"></i></a>
                    </li>
                    <!-- Notification Menu -->
                    <li class="btn-group notification">
                        <a href="javascript:;" class="btn  wave-effect" >
                            <i class="feather icon-bell"><span class="notification-count">27</span></i>
                        </a>
                    </li>
                    <li class="mobile-menu-toggle">
                        <a href="#" class="menu-toggle wave-effect">
                            <i class="feather icon-menu"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<aside class="offcanvas-menu">
    <div class="offcanvas-button">
        <a href="#" class="btn wave-effect offcanvas-toggle font-20"><span aria-hidden="true">&times;</span></a>
    </div>
    
</aside>

        

<!-- Main Menu -->
<div class="sidebar">
    <div class="logo">
        <a href="/">
            <span class="logo-emblem"><img src="https://bootadmin.org/images/boot.png" alt="BA" /></span>
            <span class="logo-full">restaurant</span>
        </a>
    </div>
    <ul id="sidebarCookie">
        <li class="spacer"></li>
        <li class="profile">
            <span class="profile-image">
                <img src="profile.png" alt="profile" />
            </span>
            <span class="profile-name">
                ADMIN
            </span>
            <span class="profile-info">
                one of the admin
            </span>
        </li>
        <li class="spacer"></li>
        <li class="title">
            <i class="feather icon-more-horizontal"></i>
            <span class="menu-title">Main</span>
        </li>
        <li class="nav-item">
            <a class="nav-link wave-effect collapsed wave-effect" data-parent="#sidebarCookie" data-toggle="collapse" href="#navDashboard" aria-expanded="false" aria-controls="page-dashboards">
                <i class="feather icon-grid"></i>
                <span class="menu-title">Dashboard</span>
                <i class="feather icon-chevron-down down-arrow"></i>
            </a>
            <div class="collapse" id="navDashboard">
                <ul class="flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link wave-effect" href="#">
                            <i class="feather icon-layout"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link wave-effect collapsed" data-parent="#sidebarCookie" data-toggle="collapse" href="#navMailbox" aria-expanded="false" aria-controls="page-mailbox">
                <i class="feather icon-mail"></i>
                <span class="menu-title">Mailbox</span>
                <i class="feather icon-chevron-down down-arrow"></i>
            </a>
            <div class="collapse" id="navMailbox">
                <ul class="flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link wave-effect" href="#">
                            <i class="feather icon-inbox"></i>
                            <span class="menu-title">Inbox</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link wave-effect" href="#">
                            <i class="feather icon-mail"></i>
                            <span class="menu-title">Email</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link wave-effect" href="#">
                            <i class="feather icon-send"></i>
                            <span class="menu-title">Compose</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link wave-effect collapsed" data-parent="#sidebarCookie" data-toggle="collapse" href="#navProfilebox" aria-expanded="false" aria-controls="page-profilebox">
                <i class="feather icon-users"></i>
                <span class="menu-title">Account</span>
                <i class="feather icon-chevron-down down-arrow"></i>
            </a>
            <div class="collapse" id="navProfilebox">
                <ul class="flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link wave-effect" href="#">
                            <i class="feather icon-user"></i>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link wave-effect" href="#">
                            <i class="feather icon-dollar-sign"></i>
                            <span class="menu-title">Billing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link wave-effect" href="#">
                            <i class="feather icon-settings"></i>
                            <span class="menu-title">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link wave-effect nav-single">
                <i class="feather icon-zap"></i>
                <span class="menu-title">Credits</span>
            </a>
        </li>
        <li class="spacer"></li>
        <li class="button-container">
            <a href="#" class="btn btn-primary display-block">LinkedIn</a>
        </li>
    </ul>
</div>

        <main>
            <div class="page-breadcrumb">
    <div class="row">
        <div class="col-6">
            <h4 class="page-title">Dashboard</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
        <?php
        $uquery="SELECT `email` FROM `login` ORDER BY `userid`";
        if($uqurn = mysqli_query($conn,$uquery)){
            $ucount = mysqli_num_rows($uqurn);
        }
        ?>
        <div class="col-6">
            <div class="text-right">
                <small>Users</small>
                <h5 class="text-info"><?php echo $ucount;?></h5>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- column -->
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-4">
                            <small>Page Viewers</small>
                            <h4 class="mb-0">20000</h4>
                        </div>
                        <div class="chart ml-auto">
                        <span class="fa fa-star "></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- column -->
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover bg-red">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-4">
                            <small>Items Added</small>
                            <h4 class="mb-0">10</h4>
                        </div>
                        <div class="chart ml-auto">
                        <span class="fa fa-star "></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- column -->
        <div class="col-sm-12 col-lg-4">
            <div class="card card-hover bg-green">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-4">
                            <small>Active Users</small>
                            <h4 class="mb-0">500</h4>
                        </div>
                        <div class="chart ml-auto">
                        <span class="fa fa-star "></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Details</h4>
                            <p class="card-subtitle">Overview of Customer Details</p>
                        </div>
                        <div class="ml-auto">
                            <div class="dl">
                            <?php
                            $x=0;
                            ?>
                                <select class="custom-select">
                                    <option value="0" selected="">Monthly</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- title -->
                </div>
                <div class="container-md">
    <div class="table-responsive">
      <?php
         $orderid_list = array();
         $dbauth = isset($_SESSION['userid']);
         $dbemail = isset($_SESSION['dbemail']);
         $dquery = "SELECT * FROM `billing`";
         if($dqurn = mysqli_query($conn,$dquery)){
            $dnum = mysqli_num_rows($dqurn);
            if($dnum > 0){
                while($drow = mysqli_fetch_assoc($dqurn))
                  {
                    $orderid_list[] = $drow['order_id'];
                  }
            }
         }
         ?>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Order Id</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Pincode</th> 
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Added On</th>
                  </tr>
                </thead>
         <?php
         foreach($orderid_list as $value){
         $query = "SELECT * FROM `billing` WHERE `order_id`='$value' ORDER BY `added_on` DESC";
         if($qrun = mysqli_query($conn,$query))
         {
           $num = mysqli_num_rows($qrun);
           if($num<1)
           {
            echo '<div style="display:flex;align-items:center;justify-content:center;height:100%;"><a href="#"><button class="btn btn-primary">Nothing ordered yet...</button></a></div>'; 
            }
           else
           {
                  while($row = mysqli_fetch_assoc($qrun))
                  {
                    ?>
                    <tr>
                      <td><a href="orderedItems.php?order_id=<?php echo $value ?>" class="btn btn-warning"><?php echo $row['order_id']; ?></a></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['phone_num']; ?></td>
                      <td><?php echo $row['address']; ?></td>
                      <td><?php echo $row['city']; ?></td>
                      <td><?php echo $row['pincode']; ?></td>
                      <td><?php echo $row['payment_type']; ?></td>
                      <td><?php echo $row['payment_status']; ?></td>
                      <td><?php echo $row['order_status']; ?></td>
                      <td><?php echo $row['added_on']; ?></td>
                    </tr>
                    <?php
                  }
           }
        }
    }
                ?>
              </table>
    </div>
  </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- column -->
        <div class="col-lg-6">
            <div class="card card-hover">
                <div class="card-body">
                    <h4 class="card-title">Current Details</h4>
                    <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="font-w700">Customer MailID</th>
                                <th class="d-none d-sm-table-cell font-w700">Date</th>
                                <th class="font-w700">Order Status</th>
                                <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Price</th>
                                <th class="font-w700 text-center" style="width: 60px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                           foreach($orderid_list as $value){
                            $query = "SELECT * FROM `billing` WHERE `order_id`='$value' ORDER BY `added_on` DESC";
                            if($qrun = mysqli_query($conn,$query))
                            {
                              $num = mysqli_num_rows($qrun);
                              if($num<1)
                              {
                               echo '<div style="display:flex;align-items:center;justify-content:center;height:100%;"><a href="#"><button class="btn btn-primary">Nothing ordered yet...</button></a></div>'; 
                               }
                              else
                              {
                                     while($row = mysqli_fetch_assoc($qrun))
                                     {
                    ?>
                            <tr>
                                <td>
                                    <span class="font-w600"><?php echo $row['email']; ?></span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted"><?php echo $row['added_on']; ?></span>
                                </td>
                                <td>
                                    <span class="font-w600 text-warning"><?php echo $row['order_status']; ?></span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    Rs.<?php echo $row['total_price'];?>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="" class="js-tooltip-enabled" data-original-title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                  }
           }
        }
    }
                ?>
                              </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- column -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ANALYTICS</h4>
                    <?php 
                         $restArr = [];
                         $count = [];
                         $q1 = "SELECT * FROM `restaurants`";
                         if($qr1 = mysqli_query($conn,$q1))
                         {
                             while($row = mysqli_fetch_assoc($qr1))
                             {
                                 $restArr[] = $row['name'];
                             }
                         }
                         foreach($restArr as $restaurant)
                         {
                            // $qr = "SELECT * FROM `cartitems` WHERE `restaurant`='$restaurant'";
                            $qr = "SELECT `order_id` FROM `cartitems` WHERE `restaurant`='$restaurant' GROUP BY `order_id`";
                            if($qrun = mysqli_query($conn,$qr))
                            {
                                $count[] = mysqli_num_rows($qrun);
                                // echo $count[0].'<br>';
                            }
                         }

                         for($i=0;$i<count($restArr);$i++)
                         {
                             $datapoints[] = array("label"=>$restArr[$i], "y"=>$count[$i]);
                         }
                        ?>
                    <script>
                        var restaurants = <?php echo json_encode($restArr); ?>;
                        var count = <?php echo json_encode($count) ?>;
                        window.onload = function () {
                            var chart = new CanvasJS.Chart("tree", {
                                title:{
                                    text: "Orders for Restaurants"              
                                },
                                data: [              
                                {
                                    // Change type to "doughnut", "line", "splineArea", etc.
                                    type: "pie",
                                    dataPoints:<?php echo json_encode($datapoints); ?>
                                }
                                ]
                            });
                            chart.render();
                        }
                    </script>
                    <div id="tree">
                    </div>
                </div>
            </div>
        </div>
        <!-- column -->
        

        </main>
    </div>

</div>



<!-- Le Javascript -->
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://bootadmin.org/scripts/vendor/bootstrap.min.js"></script>
<script src="https://bootadmin.org/scripts/vendor/library.min.js"></script>



<script src="https://bootadmin.org/scripts/core/main.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-104952515-1', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
<?php
  }
  else
  {
      header('Location:http://localhost/fprjct/index.php');
  }
?>
