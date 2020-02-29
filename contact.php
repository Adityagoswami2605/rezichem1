<?php
include('configure/configure.php');

$page_id =3;
$page_detail = get_page_detail($page_id);
$P_NAME3 		= $page_detail['P_NAME'];
$P_CONTENT3 	= $page_detail['P_CONTENT'];
$P_IMAGES3 	= $page_detail['P_IMAGE'];


$get_banner = get_banner();

$get_categories = get_categories();

$get_news_limit = get_news_limit(3);

$get_categories_limit = get_categories_limit(8);



?>

<!DOCTYPE HTML>
<html>
<head>
<title>Rezichem :: Contact Us</title>		
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/responsiveslides.css">
<script src="js/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
</script>
<meta name="keywords" content="Medicus Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" 
		/>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400' rel='stylesheet' type='text/css'>
<!--/fonts-->
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<!-- js -->
		 <script src="js/bootstrap.js"></script>
	<!-- js -->
		<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!--/script-->
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
	
	<script src="js/jquery_dash.js" type="text/javascript"></script>
<script type="text/javascript">
   function roll_over(img_name, img_src)
   {
   		document[img_name].src = img_src;
   }
</script>

<script src="js/jquery.validate.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
	DrawCaptcha()
	 $("#contactus").validate({});
	
	});	
</script>
	
	</head>
<body>
<?php  include('header.php');  ?>
		<!---start-content----->
		<div class="content">
			<div class="container">
				<!---start-contact---->
				<div class="contact">
					<div class="contact-header">
							<h3>Contact Us & Inquiry</h3>
							<ol class="breadcrumb">
							  <li><a href="<?=SITEURL?>index.php">Home</a></li>
							  <li class="active">Contact Us & Inquiry</li>						  
							</ol>
				  </div>
				  
		 <div class="contact-grids">	
			  <div class="col-md-6 contact_left">
			 		<h3>Contact Form</h3>
				   <form  name="contactus" id="contactus" action="mail-c.php" method="post">
					 <div class="form_details">
						   <input type="text" class="text" value="" name="name-c" placeholder="Enter Name" required>
						   <input type="text" class="text" name="email-c" placeholder="Enter Email" value="" required>
							<input type="text" class="text" value="" name="phone-c" placeholder="Enter Phone" required>
							<textarea value="" name="message-c" placeholder="Enter Message" required ></textarea>
						  <input type="text" class="captcha_input textbox widthsmall captach-box" id="txtCaptcha" disabled="disabled" name="c_captcha" style="width:175px; float:left;" />
                <img src="images/refresh.png" alt="" border="0" onClick="DrawCaptcha();" id="btnrefresh" class="refresh" width="18" height="18" align="absmiddle" style="float:left; margin-top:20px;" />
                <input type="text" onchange="ValidCaptcha();" id="captcha" name="captcha"  class="required captcha textbox widthsmall"  style="width:175px; float:left;" required/>
							<div class="clearfix"> </div>					   
							<input name="submit" type="submit" value="Send">
					 </div>					 
				  </form>
			 </div>
			 <div class="col-md-6 contact_right">	
				   <h3>Address</h3>
				  <div class="address">
					  <p>
					  <?=$P_CONTENT3?>
					  </p>
				  </div>					
			 </div>
			 <div class="clearfix"></div>
		 </div>

				  <div class="map">
					 <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d117503.41402104095!2d72.54119059968261!3d23.024444563727346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1437995040769"> </iframe>
					  
					
					  
				  </div>
				<!---End-contact---->		
			</div>
		</div>
	<?php
	include('footer.php');
	?>
		 <!---->
<script type="text/javascript">
		$(document).ready(function() {
				/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
				*/
		$().UItoTop({ easingType: 'easeOutQuart' });
});
</script>
<a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!----> 

	</body>
</html>

