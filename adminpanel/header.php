<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
?>
<!--header start-->

    <header class="header fixed-top clearfix">

        <!--logo start-->

        <div class="brand">



            <a href="<?=ADMINURL?>dashboard.php" class="logo" style="color:#FFFFFF;">

                <!-- <img src="images/logo.png" alt="Elala logo" height="80px"> -->
Seawind CMS		   

            </a>

            <div class="sidebar-toggle-box">

                <div class="fa fa-bars"></div>
            </div>
        </div>
         <!--logo end-->
<?php
/* $user_new_messages = get_user_unread_messages_count(); */
?>
        <img src="images/logo.jpg" style="float:left; margin-left:50px; width:200px; height:75px; background-color:#e4f9fc;">

  <img src="images/seawind-logo.jpg" style="float:left; margin-left:450px; margin-top:3px; width:100px;">

        <div class="top-nav clearfix">

            <!--search & user info start-->

            <ul class="nav pull-right top-menu">

            
                <!-- user login dropdown start-->

                <li class="dropdown">

                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                        <img alt="" src="images/user.jpg">

                        <span class="username">Welcome To <?=$_SESSION['ADMIN_ELALA_FULLNAME']?></span>

                        <b class="caret"></b>

                    </a>

                    <ul class="dropdown-menu extended logout">

                       <li><a href="profile.php"><i class=" fa fa-suitcase"></i>Profile</a></li> 
						
                      <!--   <li><a href="log-report.php"><i class="fa fa-cog"></i> Login Report</a></li> -->

                        <li><a href="settings.php"><i class="fa fa-cog"></i> Settings</a></li>

                        <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>

                    </ul>

                </li>

                <!-- user login dropdown end -->

                <li>

                    <div class="toggle-right-box">

                        <div class="fa fa-bars"></div>

                    </div>

                </li>

            </ul>

            <!--search & user info end-->

        </div>

    </header>

<!--header end-->
