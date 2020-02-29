<?php 
$index_tab_active = strpos($_SERVER['REQUEST_URI'],'index.php') > 0 ? 'class="active"' : ''; 

$about_tab_active = strpos($_SERVER['REQUEST_URI'],'about.php') > 0 ? 'class="active"' : ''; 

$download_tab_active = strpos($_SERVER['REQUEST_URI'],'download.php') > 0 ? 'class="active"' : ''; 

$events_tab_active = strpos($_SERVER['REQUEST_URI'],'events.php') > 0 ? 'class="active"' : ''; 

$client_tab_active = strpos($_SERVER['REQUEST_URI'],'clients.php') > 0 ? 'class="active"' : ''; 

$certificates_tab_active = strpos($_SERVER['REQUEST_URI'],'certificates.php') > 0 ? 'class="active"' : ''; 

$contact_tab_active = strpos($_SERVER['REQUEST_URI'],'contact.php') > 0 ? 'class="active"' : ''; 

$faq_tab_active = strpos($_SERVER['REQUEST_URI'],'faq') > 0 ? 'class="active"' : ''; 

$product_tab_active = strpos($_SERVER['REQUEST_URI'],'products.php') > 0 ? 'class="active"' : ''; 


?>

<!--start-header-->
<div class="header">
	 <!--start-container-->
	 <div class="container">
				<!--start-top-header-->
					<div class="main-header">

				<div class="clearfix"> </div>
				<div class="top-header">
										<div class="logo">
						<a href="<?=SITEURL?>index.php"><img src="images/logo.png" title="logo" width="300" height="110" /></a>
					</div>
					<div class="top-header-right">
										<ul class="support">
											<li><span><i class="tele-in"> </i>+91-9904257395</span></li>
					<li><a href="mailto:info@example.com"><i> </i>rezichemhealthcarepvtltd@gmail.com</a></li>
				</ul>
						<div class="top-header-contact-account">
							
							<div class="social">
								<ul>
							<li><a href="https://www.facebook.com/rezichemhealthcare" target="_blank"><img src="images/social-icons.png"/></a></li>
<li><a href="https://twitter.com/rezichemhealth" target="_blank"><img src="images/twitter.png" style="width:35px;"/></a></li>									 
								</ul>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!--End-top-header-->
				<!--start-main-header-->
<div class="navigation">
	<div class="container">
		<nav class="navbar navbar-default">
						<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"> </span>
				<span class="icon-bar"> </span>
				<span class="icon-bar"> </span>
			  </button>
			</div>

			<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li <?=$index_tab_active?>><a href="<?=SITEURL?>index.php">Home <span class="sr-only">(current)</span></a></li>
				<li <?=$about_tab_active?>><a href="<?=SITEURL?>about.php">About Us</a></li>
				<li <?=$product_tab_active?>><a href="<?=SITEURL?>products.php">Products </a></li>
				<li <?=$download_tab_active?>><a href="<?=SITEURL?>download.php">Download</a></li>
				<li <?=$events_tab_active?>><a href="<?=SITEURL?>events.php">Events & Updates</a></li>
				<li <?=$client_tab_active?>><a href="<?=SITEURL?>clients.php">Our Clients</a></li>
                <li <?=$certificates_tab_active?>><a href="<?=SITEURL?>certificates.php">Awards & Certificates</a></li>
                <li <?=$contact_tab_active?>><a href="<?=SITEURL?>contact.php">Contact Us & Inquiry</a></li>
			  </ul>
				
			  <div class="clearfix"> </div>
			</div><!-- /.navbar-collapse -->
		</nav>
	</div>
</div>
					<div class="clearfix"> </div>
					</div>
			  <!-- script-for-menu -->
		 <script>
				$("span.menu").click(function(){
					$(".top-nav ul").slideToggle("slow" , function(){
					});
				});
		 </script>
		 <!-- script-for-menu -->	 	
	 </div>
	<!----End-main-header----->
</div>
<div class="clearfix"> </div>
<!---End-header--->
