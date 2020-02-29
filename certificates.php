<?php
include('configure/configure.php');

$page_id =2;
$page_detail = get_page_detail($page_id);
$P_NAME2 		= $page_detail['P_NAME'];
$P_CONTENT2 	= $page_detail['P_CONTENT'];
$P_IMAGES2 	= $page_detail['P_IMAGE'];


$get_banner = get_banner();

$get_categories = get_categories();

$get_news_limit = get_news_limit(3);

$get_categories_limit = get_categories_limit(8);

$get_brochure		= get_brochure();

/*

$get_categories = get_categories();
$get_categories_limit = get_categories_limit(2);

//pre($get_categories_limit);

	$get_product = get_products_limit(8);
*/
$get_clients		= get_clients();
$get_certificate		= get_certificate();

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Rezichem :: Awards & Certificates</title>	
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
	<link type="text/css" href="css/styles.css" rel="stylesheet" media="all" />
		<script type="text/javascript" src="js/jquery.min1.js"></script>
	    <script src="js/jquery.quicksand.js" type="text/javascript"></script>
        <script src="js/jquery.easing.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
       	<script src="js/jquery.prettyPhoto.js" type="text/javascript"></script> 
        <link href="css/prettyPhoto.css" rel="stylesheet" type="text/css" />
	</head>
<body>
<?php include('header.php');  ?>
	<!--start-about-->	
	<div class="about">
		<div class="container">
			<div class="about-main">
				<h3>Awards & Certificates</h3>
				<ol class="breadcrumb">
							  <li><a href="<?=SITEURL?>index.php">Home</a></li>
							  <li class="active">Awards & Certificates</li>						  
							</ol>
				<div class="about-top">
				
					<div class="col-md-12 about-top-right">
					<!--	<h4>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</h4> -->
								  <ul class="portfolio-area">	
						<?php 
									foreach($get_certificate as $certificate_detail)
									{
										$certificate_id 			= $certificate_detail['certificate_id'];
										$certificate_name 		= $certificate_detail['certificate_name'];
										$certificate_image 		= $certificate_detail['certificate_image'];
										
									?>
			
 		
               		<li class="portfolio-item2" data-id="id-0" data-type="cat-item-4">	
			        <div>
                   <span class="image-block">
					<a class="image-zoom" href="<?=CERTIFICATEURL.$certificate_image?>" rel="prettyPhoto[gallery]" title="<?=$certificate_name?>"><img width="225" height="140" src="<?=CERTIFICATEURL.$certificate_image?>" alt="<?=$certificate_name?>" title="<?=$certificate_name?>" />                    
                    </a>
                    </span>
                   
					</div>	
                    </li>	
					<?php
}
										?>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>	 
	 <!------->
	
	 <!------->
	
</div>
<?php  include('footer.php');  ?>
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

