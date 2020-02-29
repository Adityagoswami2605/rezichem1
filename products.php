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


/*

$get_categories = get_categories();
$get_categories_limit = get_categories_limit(2);

//pre($get_categories_limit);

	$get_product = get_products_limit(8);
*/

//$get_categories = get_categories();
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Rezichem :: Our Products</title>		
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>		
<script src="js/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
</script>
<meta name="keywords" content="Medicus Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design">
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400' rel='stylesheet' type='text/css'>
<!--/fonts-->
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" > -->
   <script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

		});
	</script>
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
			$(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
	</head>
<body>
<?php include('header.php');  ?>
<!---start-content----->
<div class="content">
			<div class="container">
				<!---start-projects---->
				<div class="projects">
					<div class="projects-header">
							<h3>Products</h3>
							<ol class="breadcrumb">
							  <li><a href="<?=SITEURL?>index.php">Home</a></li>
							  <li class="active">Products</li>						  
							</ol>
						</div>
						<div class="clear"> </div>
						<div class="gallery-grids">
							<?php 
								foreach($get_categories as $category_detail)
								{
									$category_id 			= $category_detail['category_id'];
									$category_parent		= $category_detail['category_parent_id'];
									$category_parent     	= $category_parent != '0' ? get_cat_name($category_parent) : '-';  
									$category_name 			= $category_detail['category_name'];
									$category_image	 		= $category_detail['category_image'];
									$category_slug	 		= $category_detail['category_slug'];
								
								?>
							<div class="col-md-4 gallery-grid">								
								 <a class="fancybox" href="<?=SITEURL?>productdetail.php?category_slug=<?=$category_slug?>" data-fancybox-group="gallery" title="<?=$category_name?>"><img src="<?=CATEGORYURL.$category_image?>" class="img-style row6" alt=""><span> </span></a>							
								<h4><?=$category_name?></h4>						
							</div>
							<?php
                                }
	                        ?>
						<div class="clear"> </div>
					</div>
				<!---End-projects---->
			</div>
		</div>
		<?php
include('footer.php');
?>
	<!---End-container---->
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

