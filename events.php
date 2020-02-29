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

$get_news = get_news();

/*

$get_categories = get_categories();
$get_categories_limit = get_categories_limit(2);

//pre($get_categories_limit);

	$get_product = get_products_limit(8);
*/
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Rezichem :: Events & Updates</title>	
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
	<link href="css/global.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica+SC' rel='stylesheet' type='text/css'>
	</head>
<body>
<?php include('header.php');  ?>
	<!--start-about-->	
	<div class="about">
		<div class="container">
			<div class="about-main">
				<h3>Events & Updates</h3>
				<ol class="breadcrumb">
							  <li><a href="<?=SITEURL?>index.php">Home</a></li>
							  <li class="active">Events & Updates</li>						  
							</ol>
				<div class="about-top">
				
					<div class="col-md-12 about-top-right">
					<ul id="ticker_01" class="ticker">

		
			 <?php 
								foreach($get_news as $news_detail)
								{
									$news_id 		= $news_detail['news_id'];
									$news_name 		= $news_detail['news_name'];
									$news_date 		= $news_detail['news_date'];
									$news_content 		= $news_detail['news_content'];
									$news_image 		= $news_detail['news_image'];
									$news_created_date 		= $news_detail['news_created_date'];
									$news_status = $news_detail['news_status'] == '1' ? 'Published' : 'Draft';
								?>
						<li>	
		<div class="events">
			<img src="<?=NEWSURL.$news_image?>" />
			<h4>(<?=$news_date?>)<?=$news_name?></h4>
			<p><?=$news_content?></p>
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
<script>

	function tick(){
		$('#ticker_01 li:first').slideUp( function () { $(this).appendTo($('#ticker_01')).slideDown(); });
	}
	setInterval(function(){ tick () }, 5000);


	function tick2(){
		$('#ticker_02 li:first').slideUp( function () { $(this).appendTo($('#ticker_02')).slideDown(); });
	}
	setInterval(function(){ tick2 () }, 3000);


	function tick3(){
		$('#ticker_03 li:first').animate({'opacity':0}, 200, function () { $(this).appendTo($('#ticker_03')).css('opacity', 1); });
	}
	setInterval(function(){ tick3 () }, 4000);	

	function tick4(){
		$('#ticker_04 li:first').slideUp( function () { $(this).appendTo($('#ticker_04')).slideDown(); });
	}


	/**
	 * USE TWITTER DATA
	 */

	 $.ajax ({
		 url: 'http://search.twitter.com/search.json',
		 data: 'q=%23javascript',
		 dataType: 'jsonp',
		 timeout: 10000,
		 success: function(data){
		 	if (!data.results){
		 		return false;
		 	}

		 	for( var i in data.results){
		 		var result = data.results[i];
		 		var $res = $("<li />");
		 		$res.append('<img src="' + result.profile_image_url + '" />');
		 		$res.append(result.text);

		 		console.log(data.results[i]);
		 		$res.appendTo($('#ticker_04'));
		 	}
			setInterval(function(){ tick4 () }, 4000);	

			$('#example_4').show();

		 }
	});


</script>

	</body>
</html>

