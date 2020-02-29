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



if($_SESSION['ADMIN_ELALA_ID'] != '')
{
	header('location:dashboard.php');
	exit;
}

$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
	if(trim($_POST['admin_email']) != '')
	{
	  $email  = trim($_POST['admin_email']);
		$res = get_admin_detail_by_email($email);
	
	
		$emsmail= "dm@seawindsolution.com";
		if(count($res) > 1)
		{
		 $user_ids = $res['admin_id'];
		 $user_password = $res['admin_password'];
		 $user_email    = $res['admin_email'];
		 $user_name     = $res['admin_name'];
		 $user_keys 	= $res['admin_key'];
		
	$message = "<table cellspacing='0' cellpadding='0' border='0' bgcolor='ffffff' style='border:solid 1px #cccccc; max-width:550px'>
	<tbody>
	  <tr>
		<td valign='top'>
			<table cellspacing='0' cellpadding='0' border='0' width='100%'>
				<tbody><tr>
					<td colspan='2'><img border='0' height='15' style='display:block' alt='' src='' class='CToWUd'></td>
				</tr>
				<tr>
					<td>
						<img border='0' width='5' height='1' style='display:block' alt='' src='" .IMAGEURL. "logo.jpg' class='CToWUd'>
					</td>
					<td align='left' valign='middle'>
						<a target='_blank' href='".ADMINURL."'>
						<img border='0' width='150' height='130' style='display:block;margin-left:30%;' alt='Seawindsolution' src='" .IMAGEURL. "logo.jpg' class='CToWUd'>
					</a></td>
				</tr>
				<tr>
					<td colspan='2'><img border='0' height='15' style='display:block' alt='' src='https://ci6.googleusercontent.com/proxy/Id4ijy4Ye8AIlJqSZJPZl5hRy4ZT0wV0XcEnUuKi3LZ6BfUEN4RE5c6Hzl3TOqgQSVSsqCpg5Xlyx05lZJOg06MLZOM3X3yBMXs9_0j5zvV0MDLd5ZVao1Mf=s0-d-e1-ft#http://md-imgs.matrimonycdn.com//template02/images/mailers/trans.gif' class='CToWUd'></td>
				</tr>
				<tr>
					<td bgcolor='f79b4d' colspan='2'><img border='0' height='3' style='display:block' alt='' src='https://ci6.googleusercontent.com/proxy/Id4ijy4Ye8AIlJqSZJPZl5hRy4ZT0wV0XcEnUuKi3LZ6BfUEN4RE5c6Hzl3TOqgQSVSsqCpg5Xlyx05lZJOg06MLZOM3X3yBMXs9_0j5zvV0MDLd5ZVao1Mf=s0-d-e1-ft#http://md-imgs.matrimonycdn.com//template02/images/mailers/trans.gif' class='CToWUd'></td>
				</tr>
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td valign='top'>
			<table cellspacing='0' cellpadding='0' border='0' width='100%'>
				<tbody><tr>
					<td><img border='0' width='15' height='1' style='display:block' alt='' src='https://ci6.googleusercontent.com/proxy/Id4ijy4Ye8AIlJqSZJPZl5hRy4ZT0wV0XcEnUuKi3LZ6BfUEN4RE5c6Hzl3TOqgQSVSsqCpg5Xlyx05lZJOg06MLZOM3X3yBMXs9_0j5zvV0MDLd5ZVao1Mf=s0-d-e1-ft#http://md-imgs.matrimonycdn.com//template02/images/mailers/trans.gif' class='CToWUd'></td>
					<td align='left' valign='top'>
						<table cellspacing='0' cellpadding='0' border='0' width='100%'>
							<tbody><tr><td height='20'></td></tr>
							<tr>
								<td align='left' valign='top' style='font-weight:normal;font-size:1.2em;line-height:22px;font-family:arial;color:#333333'><span style='font-weight:bold'>Dear $user_name,</span></td>
							</tr>
							<tr><td height='10'></td></tr>
							<tr>
								<td valign='top' style='font-weight:normal;font-size:1.2em;line-height:22px;font-family:arial;color:#000000'>If you have just sent password recovery request, please follow this link:</td>
							</tr>
							<tr><td height='10'></td></tr>
							
							
					
							
						
							<tr><td height='25'></td></tr>
							<tr>
								<td valign='top'>
									<table cellspacing='0' cellpadding='0' border='0' align='left' width='100%'>
										<tbody><tr>
											<td width='10%'></td>
											<td align='center' valign='top'>
												<table cellspacing='0' cellpadding='0' border='0' bgcolor='d10a18' width='100%' style='border:1px solid #bd1818'>
													<tbody><tr>
														<td align='center' valign='top' style='font:normal 1.35em arial;line-height:41px;color:#ffffff;border:1px solid #e84859'><a target='_blank' style='color:#ffffff;text-decoration:none' href='".ADMINURL."changepsd.php?value=$user_ids&t=$user_keys'>Recover Password </a></td>
													</tr>
												</tbody></table>
											</td>
											<td width='10%'></td>
										</tr>
									</tbody></table>
								</td>
							</tr>
							<tr><td height='15'></td></tr>
							<tr>
								<td align='center' valign='top'>
									<table cellspacing='0' cellpadding='0' border='0'>
										<tbody><tr>										
											<td align='center' valign='middle' style='font:normal 14px arial;line-height:18px'>If you did not send password recovery request recently, just ignore this message.</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
							<tr><td height='15'></td></tr>
						</tbody></table>
					</td>
					<td><img border='0' width='18' height='1' alt='' src='https://ci6.googleusercontent.com/proxy/Id4ijy4Ye8AIlJqSZJPZl5hRy4ZT0wV0XcEnUuKi3LZ6BfUEN4RE5c6Hzl3TOqgQSVSsqCpg5Xlyx05lZJOg06MLZOM3X3yBMXs9_0j5zvV0MDLd5ZVao1Mf=s0-d-e1-ft#http://md-imgs.matrimonycdn.com//template02/images/mailers/trans.gif' class='CToWUd'></td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr><td bgcolor='f79b4d'><img border='0' height='3' style='display:block' alt='' src='https://ci6.googleusercontent.com/proxy/Id4ijy4Ye8AIlJqSZJPZl5hRy4ZT0wV0XcEnUuKi3LZ6BfUEN4RE5c6Hzl3TOqgQSVSsqCpg5Xlyx05lZJOg06MLZOM3X3yBMXs9_0j5zvV0MDLd5ZVao1Mf=s0-d-e1-ft#http://md-imgs.matrimonycdn.com//template02/images/mailers/trans.gif' class='CToWUd'></td></tr>
	<tr><td height='15'></td></tr>
	<tr>
		<td valign='top'>
			<table cellspacing='0' cellpadding='0' border='0'>
				<tbody><tr>
					<td><img border='0' width='18' height='1' alt='' src='https://ci6.googleusercontent.com/proxy/Id4ijy4Ye8AIlJqSZJPZl5hRy4ZT0wV0XcEnUuKi3LZ6BfUEN4RE5c6Hzl3TOqgQSVSsqCpg5Xlyx05lZJOg06MLZOM3X3yBMXs9_0j5zvV0MDLd5ZVao1Mf=s0-d-e1-ft#http://md-imgs.matrimonycdn.com//template02/images/mailers/trans.gif' class='CToWUd'></td>
					<td valign='top' style='font:normal 12px/16px arial;color:#777777'>Best Regards,<br> Seawind Solution </td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr><td height='15'></td></tr>
</tbody></table>";			
			
			
			
	
			$subject = 'Password Recovery ';
			
			
		$headers = 'From: '.$emsmail.'' . "\r\n" .
		'Reply-To: '.$emsmail.'' . "\r\n" .
		'Content-type: text/html; charset=utf-8' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
			
			// To send HTML mail, the Content-type header must be set
	/*		$headers  = 'From :  Seawind Solution ' . "\r\n";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'Cc:dipesh@seawindsolution.com' . "\r\n";
		*/	
			// Mail it
			mail($email, $subject, $message, $headers);
			//mail('vtshukla.b4s@gmail.com', $subject, $message, $headers);
			
			$message="Your password has been sent successfully to your email";
						echo "<script language=javascript> alert('$message');</script>"; 
echo '<SCRIPT LANGUAGE="JavaScript">
						document.location.href="index.php" </SCRIPT>';
			
			
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
}
if($error == 1)
{
	$error_message = '<div class="notification n-error">We could not found your information in our database. Please try again</div>';
}




$styles  = include_styles('style.css,style-responsive.css,bs3/css/bootstrap.min.css,bootstrap-reset.css,assets/font-awesome/css/font-awesome.css');

 

?>

<?=DOCTYPE;?>

<?=XMLNS;?>

<head>

<?=CONTENTTYPE;?>

<title> Forgot Password</title>

<?=$styles;?>

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
  <div class="header-right"><img src="images/contact.jpg"/> <h4>CONTACT <br/>SUPPORT TEAM</h4>
  </div>
  </div>
  </div>

  <div class="container">



      <form class="form-signin" method="post" action="forgot-password.php">

	  

        <h2 class="form-signin-heading">Forgot Password</h2>

		<?=$error_message;?>

        <div class="login-wrap">

            <div class="user-login-info">

                <input type="email" class="form-control" placeholder="Email" autofocus  name="admin_email" required>

            
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



  </body>

</html>

