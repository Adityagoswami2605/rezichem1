<?php 

session_start();

include('configure/configure.php');
/*
if($_SESSION['ADMIN_ELALA_ID'] != '')
{
//	header('location:dashboard.php');
//	exit;
}



$error_message = '';

$error = 0;	


if($_POST['submit'])
{
   $email=$_POST['email'];
$get_user_detail_by_emails =get_user_detail_by_emails($email);

   $subject = "FORGOT INFORMATION";
   $body = "<b>FORGOT PASSWORD INFORMATION</b> 

	       <br><br> <b>Notification : This $email </b> Id Forgot Password . <br> This $email </b> Id Request For Password . <br> ";
			
	        $headers = 'From: '.$email.'' . "\r\n" .
		'Reply-To: '.$email.'' . "\r\n" .
		'Content-type: text/html; charset=utf-8' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	
	//put your email address here
	
	mail("vishal@seawindsolution.com", $subject, $body, $headers); 

    $res1 = user_exists1($email);

		if(count($res1) > 1)
		{

			$_SESSION['ADMIN_ELALA_ID'] 	  = $res1['user_id'];
			$_SESSION['ADMIN_ELALA_USERNAME']     = $res1['username'];
			$_SESSION['ADMIN_ELALA_EMAIL']    = $res1['email'];
			$_SESSION['ADMIN_ELALA_PASSWORD'] = $res1['password'];


              $subject1 = "USER INFORMATION";
	      $body1 = "<b>USER INFORMATION</b>
		           <br><br> <b>Email Id : '".$_SESSION['ADMIN_ELALA_EMAIL']."' </b> 
                           <br><b>Password :  $get_user_detail_by_emails  </b> <br> ";
			
$email1 =$_SESSION['ADMIN_ELALA_EMAIL'];	        
$headers1 = 'From: '.$email1.'' . "\r\n" .
		'Reply-To: '.$email1.'' . "\r\n" .
		'Content-type: text/html; charset=utf-8' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	
	//put your email address here
	
	mail("$email", $subject1, $body1, $headers1);             
	echo '<script>';
		echo 'alert("Thanks for Contact us,Our executive contact you soon!");';
		echo 'location.href="index.php"';
		echo '</script>';
			
			exit;                 

               }
}






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
*/

               $memberid = $_REQUEST['value'];
                $member_key = $_REQUEST['t'];
		   
		   
if($memberid != '')
{          
  $user_detail= adminget_user_detail($memberid);            
  $user_key = $user_detail['admin_key'];        
  
   if($member_key==$user_key) {              

$error_message = '';
$error = 0;           
if(count($_POST) > 0)
{


if(trim($_POST['admin_password']) != trim($_POST['admin_conpassword']))
{
		$confirmpassword_error = '<span class="notification-input ni-error">Password does not match.</span>';
		
		 $error = 1;	

}
	
	            else{
                                $data['admin_password'] = md5($_POST['admin_password']);
                                                                
                                update_data('admin',$data,'admin_id ='.$memberid);
                                header('location:index.php');
                                /*$success_message = ' <div>
                                <span class="notification n-success">Your password is successfully changed.</span>
                            </div>';*/
                }
               
                 
                if($error == 1)
                {
                               
                }
}}
}else {                   header('location:index.php');}
?>



<?php


$styles  = include_styles('style.css,style-responsive.css,bs3/css/bootstrap.min.css,bootstrap-reset.css,assets/font-awesome/css/font-awesome.css');

 

?>

<?=DOCTYPE;?>

<?=XMLNS;?>

<head>

<?=CONTENTTYPE;?>

<title> Change Password</title>




<?=$styles;?>



<meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="http://ufonts.com/fonts/franklin-gothic-demi-cond.html" rel="stylesheet" /> 
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
       
        
      

<script src="js/jquery/jquery-1.3.2.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/jquery.validation.functions.js" type="text/javascript"></script>


  <script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
              
                jQuery("#ValidPassword").validate({
                    expression: "if (VAL.length > 5 && VAL) return true; else return false;",
                    message: "Please enter a valid Password"
                });
                jQuery("#ValidConfirmPassword").validate({
                    expression: "if ((VAL == jQuery('#ValidPassword').val()) && VAL) return true; else return false;",
                    message: "Confirm password field doesn't match the password field"
                });
              
				jQuery('.AdvancedForm').validated(function(){
					alert("Use this call to make AJAX submissions.");
				});
            });
            /* ]]> */
        </script>	

</head>

  <body class="login-body">
  
  <div class="header">
  <div class="headerin">
  <div class="headerleft"><h3>Seawind CMS</h3>
  </div>
  <div class="header-middle"><img src="img/logo.png"/></div>
  <div class="header-right"><img src="images/contact.jpg"/> <h4>CONTACT <br/>SUPPORT TEAM</h4>
  </div>
  </div>
  </div>

  <div class="container">



      <form class="form-signin" method="post" action="">

	  

        <h2 class="form-signin-heading">Change Password</h2>

		<?=$error_message;?>
        
        <?=$confirmpassword_error?>

        <div class="login-wrap">

            <div class="user-login-info">

                <input type="password" class="form-control" placeholder="Password" autofocus  name="admin_password" id="ValidPassword" >
                
                <input type="password" class="form-control" placeholder="Confirm Password" autofocus  name="admin_conpassword" id="ValidConfirmPassword" >
                
               
            </div>

            <label class="checkbox">

                <button class="btn btn-lg btn-login btn-block" type="submit">Submit</button>
                
               <!--   <input type="checkbox" value="remember-me"> Submit -->

          <!--      <span class="pull-right">
                
                <input type="checkbox" value="remember-me"> Reset
                
                 </span>
 -->
            </label>
<!--
                    <a data-toggle="modal" href="#myModal" style="margin-left:79px;">Forgot Your Password ?</a>

-->

               

         



        </div>



          <!-- Modal -->

          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">

              <div class="modal-dialog">

                  <div class="modal-content">

                      <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                          <h4 class="modal-title">Forgot Password ?</h4>

                      </div>

                      <div class="modal-body">

                          <p>Enter your e-mail address below to reset your password.</p>

                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">



                      </div>

                      <div class="modal-footer">

                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>

                          <button class="btn btn-success" type="button">Submit</button>

                      </div>

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
                    <div class="lefttext"><a href="google.com" target="_blank">Domain Web Hosting</a></div>
                    <div class="services1">VPS & Dedicated Services</div>
                    <div class="services2">Web Designing & Development</div>
          </div> 
          <div class="service-middle"><img src="img/logo.jpg"></div>
          <div class="footer1">
            <div class="righttext">Search Engine Optimization</div>
            <div class="rightservices1">Bulk Email & Builk SMS</div>
            <div class="rightservices2">Online Advertisement</div>
          </div>
           <div class="clear"></div>
   
  </div>
 </div>


    <!-- Placed js at the end of the document so the pages load faster -->



    <!--Core js-->

    <script src="js/lib/jquery.js"></script>

    <script src="bs3/js/bootstrap.min.js"></script>

<script type="text/javascript">
            /* <![CDATA[ */
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
            /* ]]> */
        </script>
        <script type="text/javascript">
            /* <![CDATA[ */
            try {
                var pageTracker = _gat._getTracker("UA-10628239-1");
                pageTracker._trackPageview();
            } 
            catch (err) {
            }
            /* ]]> */
        </script>

  </body>

</html>

