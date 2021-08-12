<div class="topbar">
    <span style="font-size:30px;cursor:pointer;color:white;float:left;margin:15px;"  onclick="openNav()">&#9776;</span>
    <a href="#"><span style="font-size:30px;cursor:pointer;color:white;float:left;margin:15px;">Food4U</span></a>
    <span style="font-size:110%;cursor:pointer;color:white;float:right;margin:15px;" class="btn drpbtn"><?php echo $_SESSION['user_name']; ?>
      <div class="drpdown-content">
        <a href="profile.php">Profile</a>
        <a href="../googleLogin/logout.php">Logout</a>
      </div>
    </span>
</div>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <button class="btn btn-secondary ml-4" data-toggle="collapse" data-target="#navdashBoard">Dashboard</button>
    <div id="navdashBoard" class="collapse" style="color:white;">
      <ul style="">
        <li style="list-style-type:none;">
          <a href="#restaurant" style="font-size:100%;color:white;padding-left:3px;">Restaurants</a>
        </li>
      </ul>
    </div>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>
