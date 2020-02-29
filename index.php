<?php
include('configure/configure.php');
$_SESSION['rand_string'] = rand_string(6);


$page_id =1;
$page_detail = get_page_detail($page_id);
$P_NAME1 		= $page_detail['P_NAME'];
$P_CONTENT1 	= $page_detail['P_CONTENT'];
$P_IMAGES1 	= $page_detail['P_IMAGE'];


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
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Rezichem :: Index</title>	
	
<script src="js/jquery_dash.js" type="text/javascript"></script>


<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
</script>
<meta name="keywords" content="" />
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<script src="js/jquery.min.js"> </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400' rel='stylesheet' type='text/css'>
<!--/fonts-->
<link rel="stylesheet" href="css/responsiveslides.css">	
<script src="js/responsiveslides.min.js"></script>
<script>
// You can also use "$(window).load(function() {"
	$(function () {

	  // Slideshow 1
	  $("#slider1").responsiveSlides({
		maxwidth: 1600,
		speed: 600
	  });
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
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>

<script language="javascript" type="text/javascript">
		$(function() {
    			$("#amazon_scroller1").amazon_scroller({
                    scroller_title_show: 'enable',
                    scroller_time_interval: '3000',
                    scroller_window_background_color: "none",
                    scroller_window_padding: '10',
                    scroller_border_size: '3',
                    scroller_border_color: '#f2f2f2',
                    scroller_images_width: '275',
                    scroller_images_height: '250',
                    scroller_title_size: '0',
                    scroller_title_color: 'black',
                    scroller_show_count: '3',
                    directory: 'images'
					
                });
            });
        </script> 

 <link href="css/amazon_scroller.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="js/amazon_scroller.js"></script>   

	
	
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
			<!--start-image-slider---->
					<div class="image-slider">
						<!-- Slideshow 1 -->
					    <ul class="rslides" id="slider1">
							<?php 
							foreach($get_banner as $banner_detail)
							{
								$banner_id 			= $banner_detail['banner_id'];
								$banner_name 		= $banner_detail['banner_name'];
								$banner_image 		= $banner_detail['banner_image'];
								
						?>
						 <li> <img src="<?=BANNERURL.$banner_image?>" alt="<?=$banner_name?>" style="height:480px !important;" />	</li> 
                          <?php
							}
								?>
					    
					    </ul>
						 <!-- Slideshow 2 -->
						<!-- <div class="banner-grids">
						 	<div class="container">
						 	<div class="banner-grid1">
					      		<h3>Clinic News</h3>
					      		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
					      			doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo </p>
					      	</div>
					      	<div class="banner-grid2">
					      		<h3>Top Doctors</h3>
					      		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
					      			doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo </p>
					      	</div>
					      	<div class="banner-grid3">
					      		<h3>24 Hours Service</h3>
					      		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
					      			doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo </p>
					      	</div>
					      	<div class="banner-grid4">
					      		<h3>Opening Hours</h3>
								<ul>
									<li>Morning-friday<span>8:00-17-00</span></li>
									<li>Morning-friday<span>8:00-17-00</span></li>
									<li>Morning-friday<span>8:00-17-00</span></li>
									<li>Morning-friday<span>8:00-17-00</span></li>
								</ul>
					      	</div>
					      	</div>
						 </div>-->
					</div>
					<!--End-image-slider---->
		 <!---start-content----->
		 
		 <!---start-content//----->
		
			 <div class="container">
				 <div class="recent-head">
					 <h3><?=$P_NAME1?></h3>
					 <p><?=$P_CONTENT1?></p>
				 </div>
		<!--		 <div class="charitys">
					 <div class="col-md-4 chrt_grid">
						 <div class="chrty">
							  <h3>Antimibrobial</h3>
							  <p>Curabitur convallis rutrum erat nec vestibulum. Sed iaculis hendrerit lectus sit amet lobortis. 
							  Suspendisse ultrices nec justo nec condimentum. Fusce vel justo sem.Donec vulputate magna finibus molestie tellus.</p>                              
                              <div class="button">
                                <a> Read More </a>
                              </div>   
                              
						 </div>
					 </div>
					 <div class="col-md-4 chrt_grid middle">
						 <div class="chrty">
							  <h3>Nsaids</h3>
							  <p>Curabitur convallis rutrum erat nec vestibulum. Sed iaculis hendrerit lectus sit amet lobortis. 
							  Suspendisse ultrices nec justo nec condimentum. Fusce vel justo sem.Donec vulputate magna finibus molestie tellus.</p>                             
                              <div class="button">
                                <a> Read More </a>
                              </div> 
                              
						 </div>
					 </div>
					 <div class="col-md-4 chrt_grid">
						 <div class="chrty">
							  <h3>Hyperacidity</h3>
							  <p>Curabitur convallis rutrum erat nec vestibulum. Sed iaculis hendrerit lectus sit amet lobortis. 
							  Suspendisse ultrices nec justo nec condimentum. Fusce vel justo sem.Donec vulputate magna finibus molestie tellus.</p>                              
                               <div class="button">
                               <a> Read More </a>
                               </div> 
                              
						 </div>
					 </div>
					 <div class="clearfix"> </div>
				 </div> -->
				 <div class="clearfix"> </div>
			 </div>
		 	 
		 <!---->
		 <div class="content">
		      <div class="container">				 
					
                     <div class="scrolling">
                          <div id="amazon_scroller1" class="amazon_scroller" >
                                 <div class="amazon_scroller_mask">
                                    <ul>
										<?php 
								foreach($get_categories as $category_detail)
								{
									$category_id 			= $category_detail['category_id'];
									$category_name 			= $category_detail['category_name'];
									$category_image	 		= $category_detail['category_image'];
									
							?>
                                
									  <li>	<img src="<?=CATEGORYURL.$category_image?>" width="210" height="210"></li>
									<?php
								}
									?>
										
                                 </ul>
                                </div>
                                      <!--  <ul class="amazon_scroller_nav">
                                           <li></li>
                                           <li></li>
                                       </ul> -->
                              <div style="clear: both"></div>
                         </div> 
                     </div>
                     
					 <div class="clearfix"> </div>
				</div>
		     </div>
	     </div>
		 <!---->
		 <div class="featured">
			 <div class="container">
			 <div class="project_grids">
				 <div class="col-md-4 project1 fetur">
                 
				
			 		<h3>Contact Form</h3>
				    <form  name="contactus" id="contactus" action="mail-c.php" method="post">
					 <div class="form_details">
						   <input type="text" class="text" value="" name="name-c" placeholder="Enter Name" required>
						   <input type="text" class="text" name="email-c" placeholder="Enter Email" value="" required>
							<input type="text" class="text" value="" name="phone-c" placeholder="Enter Phone" required>
							<textarea value="" name="message-c" placeholder="Enter Message" required ></textarea>
						  <input type="text" class="captcha_input textbox widthsmall captach-box" id="txtCaptcha" disabled="disabled" name="c_captcha" style="width:175px; float:left;"  />
                <img src="images/refresh.png" alt="" border="0" onClick="DrawCaptcha();" id="btnrefresh" class="refresh" width="18" height="18" align="absmiddle" style="float:left; margin-top:20px;" />
                <input type="text" onchange="ValidCaptcha();" id="captcha" name="captcha"  class="required captcha textbox widthsmall"  style="width:175px; float:left;" required/>
							<div class="clearfix"> </div>					   
							<input name="submit" type="submit" value="Send">
					 </div>					 
				  </form>
			
					 
				 </div> 
				 <div class="col-md-4 project2 fetur">
					 <h3>News & Event</h3>
					 <?php 
								foreach($get_news_limit as $news_detail)
								{
									$news_id 		= $news_detail['news_id'];
									$news_name 		= $news_detail['news_name'];
									$news_date 		= $news_detail['news_date'];
									$news_image 		= $news_detail['news_image'];
									$news_content 		= $news_detail['news_content'];
									$news_created_date 		= $news_detail['news_created_date'];
									$news_status = $news_detail['news_status'] == '1' ? 'Published' : 'Draft';
								?>
					 <div class="event">
						 <h5><a href="<?=SITEURL?>events"><?=$news_date?></a></h5>
						 <p><?=$news_content?></p>
					 </div>
					 <?php
								}
									?>
					
				 </div>
				 <div class="col-md-4 project3 fetur">
					 <h3>Our Products</h3>
					 <ul>
						 <?php 
								foreach($get_categories_limit as $category_detail)
								{
									$category_id 			= $category_detail['category_id'];
									$category_name 			= $category_detail['category_name'];
									$category_image	 		= $category_detail['category_image'];
									$category_slug	 		= $category_detail['category_slug'];
							?>
                                
						 <li><a href="<?=SITEURL?>productdetail.php?category_slug=<?=$category_slug?>"><span>></span><?=$category_name?> </a></li>
						<?php
								}
									?>
				     </ul>
				 </div>
				 <div class="clearfix"> </div>
			 </div>
			 </div>
		 </div>
		 <!---->
		 <?php  include('footer.php');  ?>
  </div>
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

