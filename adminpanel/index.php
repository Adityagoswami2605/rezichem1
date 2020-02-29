<?php 

session_start();

include('configure/configure.php');



if($_SESSION['ADMIN_ELALA_ID'] != '')

{

	header('location:dashboard.php');

	exit;

}



$error_message = '';

$error = 0;	
if(count($_POST) > 0)

{

	if(trim($_POST['admin_username']) != '' && trim($_POST['admin_password']) != '')

	{
        
		$res = adminuser_exists($_POST['admin_username'],$_POST['admin_password']);

		if(count($res) > 1)

		{

			$_SESSION['ADMIN_ELALA_ID']    = $res['admin_id'];

      $_SESSION['ADMIN_ELALA_USERNAME'] = $res['admin_username'];
      $_SESSION['ADMIN_ELALA_FULLNAME'] = $res['admin_name'];
      $_SESSION['ADMIN_ELALA_EMAIL']    = $res['admin_email'];
      $_SESSION['ADMIN_ELALA_VISIT']    = $res['admin_visit'];
      $_SESSION['ADMIN_ELALA_IP']     = $_SERVER['REMOTE_ADDR'];
      
      

      $data['admin_visit'] = $current_date;

      $data['admin_ip']    = $_SERVER['REMOTE_ADDR'];
	  
	  
	  
		$today_date = date("d-m-Y");	
		$current_time = date("h:i:sa");

		$data1['report_date'] = $today_date;
		$data1['report_time'] = $current_time;
		$data1['report_status'] = 1;
		
		$insert_id = insert_data('log_report',$data1);
		
		
		

      update_data('admin',$data,'admin_id='.$_SESSION['ADMIN_ELALA_ID']);
		
		
		
	
			header('location:dashboard.php');

			exit;

		}	

		else

		{

			$error = 1;

		}

	}

	else

	{

		$error = 1;

	}

	 

	if($error == 1)

	{

		$error_message = ' <div class="alert alert-block alert-danger fade in">

                                <span>Please correct given information.</span>

                            </div>

							

							';

	}

}



$styles  = include_styles('style.css,style-responsive.css,bs3/css/bootstrap.min.css,bootstrap-reset.css,assets/font-awesome/css/font-awesome.css');

 

?>

<?=DOCTYPE;?>

<?=XMLNS;?>

<head>

<?=CONTENTTYPE;?>

<title> Login</title>

<?=$styles;?>
<link rel="stylesheet" type="text/css" href="http://localhost/dashboard/rezichem/adminpanel/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://localhost/dashboard/rezichem/adminpanel/css/style-responsive.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://localhost/dashboard/rezichem/adminpanel/css/bs3/css/bootstrap.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://localhost/dashboard/rezichem/adminpanel/css/bootstrap-reset.css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="http://ufonts.com/fonts/franklin-gothic-demi-cond.html" rel="stylesheet" />
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

</head>

  <body class="login-body">
  
  <div class="header">
  <div class="headerin">
  <div class="headerleft"><h3>Seawind CMS</h3>
  </div>
   <div class="header-middle"><img src="images/logo.jpg" style="width:210px; height:100px; background-color:#e4f9fc;"/></div>
  <div class="header-right"><a href="http://www.india.seawindsolution.com/quick-contact.html" target="_blank"><img src="images/contact.jpg" /> <h4>CONTACT <br/>SUPPORT TEAM</h4></a>
  </div>
  </div>
  </div>

  <div class="container">



      <form class="form-signin" method="post">

	  

        <h2 class="form-signin-heading">Please Login</h2>

		<?=$error_message;?>

        <div class="login-wrap">

            <div class="user-login-info">

                <input type="text" class="form-control" placeholder="Username" autofocus  name="admin_username">

                <input type="password" class="form-control" placeholder="Password" name="admin_password">

            </div>

            <label class="checkbox">

                <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
                
               <!--   <input type="checkbox" value="remember-me"> Submit -->

          <!--      <span class="pull-right">
                
                <input type="checkbox" value="remember-me"> Reset
                
                 </span>
 -->
            </label>

               <!--     <a data-toggle="modal" href="#myModal" style="margin-left:79px;">Forgot Your Password ?</a> -->

    <a href="forgot-password.php" style="margin-left:79px;">Forgot Your Password ?</a> 

               

         


        </div>



          <!-- Modal -->

          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">

              <div class="modal-dialog">

                  <div class="modal-content">
<form name="form" method="post" action="index.php"> 
                      <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                          <h4 class="modal-title">Forgot Password ?</h4>

                      </div>

                      <div class="modal-body">

                          <p>Enter your e-mail address below to reset your password.</p>

                          <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">



                      </div>

                      <div class="modal-footer">

                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>

                          <button class="btn btn-success" type="submit">Submit</button>

                      </div>
</form>
                  </div>

              </div>

          </div>

          <!-- modal -->



      </form>
      
    



    </div>

<div class="footer-mainwrapper">
  <div class="footer-main">
          <div class="footertext">Version-sw.2.0.1 </div>
          <div class="footerright">www.seawindsolution.com</div>
  </div>
  <div class="clear"></div>
  <div class="footer-bottom">
          <div class="footercontain">
                    <div class="lefttext"><a href="http://www.india.seawindsolution.com/web-hosting.html" target="_blank">Domain Web Hosting</a></div>
                    <div class="services1"><a href="http://www.india.seawindsolution.com/vps-hosting.html" target="_blank">VPS & Dedicated Services</a></div>



                    <div class="services2"><a href="http://www.india.seawindsolution.com/web-design-company.html" target="_blank">Web Designing & Development</a></div>
          </div> 
          <div class="service-middle"><img src="img/logo.jpg"></div>
          <div class="footer1">
            <div class="righttext"><a href="http://www.india.seawindsolution.com/search-engine-optimization-seo.html" target="_blank">Search Engine Optimization</a></div>
            <div class="rightservices1"><a href="http://www.india.seawindsolution.com/bulk-sms-email-marketing.html" target="_blank">Bulk Email & Builk SMS</a></div>
            <div class="rightservices2"><a href="http://www.india.seawindsolution.com/ppc-ad-campaigns.html" target="_blank">Online Advertisement</a></div>
          </div>
           <div class="clear"></div>
   
  </div>
 </div>


    <!-- Placed js at the end of the document so the pages load faster -->



    <!--Core js-->

    <script src="js/lib/jquery.js"></script>

    <script src="bs3/js/bootstrap.min.js"></script>



  </body>

</html>

